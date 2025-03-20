import './bootstrap';
import 'simple-datatables/dist/style.css';
import { DataTable } from 'simple-datatables';

console.log('Hello World from Webpack Encore!');

document.addEventListener("DOMContentLoaded", function() {
    const usersTable = new DataTable("#usersTable", {
        searchable: true,
        perPage: 10,
        perPageSelect: [10, 20, 30, 50],
    });
    const loginsTable = new DataTable("#loginsTable", {
        searchable: true,
        perPage: 10,
        perPageSelect: [10, 20, 30, 50],
    });
});
