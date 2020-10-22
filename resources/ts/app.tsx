import run from "@cycle/run";
import { makeDOMDriver } from "@cycle/dom";
import { makeHTTPDriver } from "@cycle/http";
import { withState } from "@cycle/state";
import isolate from "@cycle/isolate";
import xs, { Stream } from "xstream";
import Snabbdom from 'snabbdom-pragma';
import { CatalogueListingPane } from "./components/catalogue-listing";
import { CatalogueState, Sinks, Sources } from "./types";
import { flattenSinks } from "./cycle-utilities/flatten-sinks";
import { allBut } from "./cycle-utilities/all-but";
import delay from "xstream/extra/delay";

function main ( sources: Sources ): Sinks {
    // HTTP requests
    const http = ( sources ) => xs.merge(
        sources.state.stream
            .map( state => {
                if ( state.childState?.update ) {
                    return xs.combine(
                        xs.of( {
                            url: '/api/catalogues',
                            method: 'GET',
                            withCredentials: true,
                            accept: 'application/json',
                            category: 'catalogues'
                        } )
                    );
                }
            } ).startWith( {
                url: '/api/catalogues',
                method: 'GET',
                withCredentials: true,
                accept: 'application/json',
                category: 'catalogues'
            } )
    ).compose( delay( 500 ) );

    // Our intention
    const intent = ( sources ) => sources.HTTP.select( 'catalogues' );

    // Manipuldate data
    const model = ( stream$ ) => stream$
        .map( response => response.replaceError( err => xs.of( err ) ) )
        .flatten()
        .map( response => response.body )
        .startWith( [] );

    // Reducer
    const reduce = sources => model( intent( sources ) )
        .map( state => function reducer ( previousState ) {
            return { ...previousState, catalogues: state };
        } );

    // Catalogue listing - loose coupling here!
    const catalogueListing = isolate( CatalogueListingPane, {
        // Nice and pure state with lenses
        state: {
            get: ( state: CatalogueState ) => state,
            set: ( state, childState ): CatalogueState => ( { ...state, childState } )
        }
    } )( sources );

    // Flatten sinks into a unified stream of data
    // Child components recieve state as a stream 😊
    return flattenSinks<Sinks>(
        catalogueListing,

        {
            HTTP: http( sources ),
            state: reduce( sources )
        }
    );
}

run( withState( main as any ) as any, {
    DOM: makeDOMDriver( '#app' ),
    HTTP: makeHTTPDriver()
} );