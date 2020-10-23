import { Reducer } from '@cycle/state';
import Snabbdom from 'snabbdom-pragma';
import xs, { Stream } from 'xstream';
import { Catalogue, CatalogueState, Sinks, Sources } from '../types';
import { Card } from "./templates/card";
import { Table, Row } from "./templates/table";

export const CatalogueListingPane = ( sources: Sources ): Sinks => {
    // HTTP stream
    const http = sources => sources.DOM.select( '.generate' )
        .events( 'click', { preventDefault: true } )
        .mapTo( {
            url: '/api/generate',
            method: 'GET',
            withCredentials: true,
            accept: 'application/json',
            category: 'update'
        } );

    // Intention
    const intent = sources => sources.state.stream;

    // Model
    const model = stream$ => stream$;

    // Render view
    const view = ( state$: Stream<CatalogueState> ) => state$.map( state => {
        // Map products
        const products = state.catalogues
            .map( catalogue => catalogue.products );

        // Find a catalogue by it's id
        const findCatalogueById = ( id ): Catalogue => state.catalogues
            .filter( catalogue => catalogue.id === id )
            .reduce( ( previous, next ) => next, null );

        return <div>
            { Card( "Products", [
                <a href="/download" className="btn btn-secondary my-4">Download</a>,
                <div className="d-flex flex-column">
                    <button className="btn btn-primary generate">Generate Random</button>

                    {/* Product listing */ }
                    <div className="my-2">
                        <h6>Full Product Listing</h6>
                        {
                            products.length > 0
                                ? products.map( cataloguesProducts => {
                                    return <details>
                                        <summary>{ findCatalogueById( cataloguesProducts[ 0 ].catalogue_id ).name || 'Unknown' }</summary>

                                        { Table(
                                            [ 'price', 'name' ],
                                            cataloguesProducts.map( product => Row( [ product.price, product.name ] ) )
                                        ) }
                                    </details>;
                                } )
                                : <i className="fas fa-spinner fa-spin"></i>
                        }
                    </div>
                </div>
            ] ) }
        </div>;

    } );

    return {
        DOM: view( model( intent( sources ) ) ),
        HTTP: http( sources ),
        state: sources.HTTP.select( 'update' )
            .map( response => response.replaceError( err => xs.of( err ) ) )
            .flatten()
            .map( (): Reducer<CatalogueState> => function reducer ( previous ) {
                return { ...previous, update: true };
            } )
    };
};