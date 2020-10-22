import run from "@cycle/run";
import { DOMSource, makeDOMDriver, VNode } from "@cycle/dom";
import { HTTPSource, makeHTTPDriver, RequestInput } from "@cycle/http";
import xs, { Stream } from "xstream";
import "snabbdom-pragma";

interface Sources {
    DOM: DOMSource,
    HTTP: HTTPSource;
}

interface Sinks {
    DOM: Stream<VNode>,
    HTTP: Stream<RequestInput>;
}

function main ( sources: Sources ): Sinks {
    // HTTP requests
    const http = ( sources ) => xs.merge(
        xs.of( {
            url: '/api/graphql',
            method: 'POST',
            withCredentials: true,
            accept: 'application/json',
            send: {
                query: `{
                    catalogues {
                        name,
                        products {name, price}
                    }
                }`
            }
        } ),

        xs.of( {
            url: '/api/products',
            method: 'GET',
            withCredentials: true,
            accept: 'application/json',
        } )
    );

    // Our intent
    const intent = ( sources ) => sources.HTTP.select( 'catalogues' );

    // Manipuldate data
    const model = ( stream$ ) => stream$
        .map( response => response.replaceError( err => xs.of( err ) ) )
        .flatten()
        .map( response => response.body.data )
        .startWith( null );

    // View
    const view = ( state$ ) => state$
        .map( state => {
            console.log( state );
        } );

    return {
        DOM: view( model( intent( sources ) ) ),
        HTTP: http( sources )
    };
}

run( main as any, {
    DOM: makeDOMDriver( '#dom' ),
    HTTP: makeHTTPDriver()
} );