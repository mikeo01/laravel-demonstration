import { VNode } from '@cycle/dom';
import Snabbdom from 'snabbdom-pragma';

export const Table = ( thead: string[], slot: VNode[] ) => <table className="table table-hover table-striped">
    <thead>
        { thead.map( thead => <th>{ thead }</th> ) }
    </thead>
    { slot }
</table>;

export const Row = ( columns: any[] ) => <tr>
    { columns.map( text => <td>{ text }</td> ) }
</tr>;