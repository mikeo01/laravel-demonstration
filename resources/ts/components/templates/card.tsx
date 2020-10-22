import { VNode } from '@cycle/dom';
import Snabbdom from 'snabbdom-pragma';

export const Card = ( title, slot: VNode[] ) => <div className="card">
    <div className="card-body">
        <h1 className="card-title">{ title }</h1>

        { slot }
    </div>
</div>;