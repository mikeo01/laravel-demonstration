import { DOMSource, VNode } from "@cycle/dom";
import { HTTPSource, RequestInput } from "@cycle/http";
import { Reducer, StateSource } from "@cycle/state";
import { Stream } from "xstream";

export interface Sources {
    DOM: DOMSource,
    HTTP: HTTPSource;
    state: StateSource<CatalogueState>;
}

export interface Sinks {
    DOM?: Stream<VNode>,
    HTTP?: Stream<RequestInput>;
    state?: Stream<Reducer<CatalogueState>>;
}

export interface Product {
    id: number;
    catalogue_id: number;
    name: string;
    price: number;
}

export interface Catalogue {
    id: number;
    name: string;
    products: Product[],
    stock: number;
    updated_at: string;
}

export interface CatalogueState {
    catalogues?: Catalogue[];
    update?: boolean;
}
