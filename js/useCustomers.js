import {customers } from './customers.js';


    const tbody = document.getElementById('customer-table-body');

    customers.forEach(customer => {
        const tr = document.createElement('tr');
        // console.log('hello');
        tr.innerHTML = `
            <td>${customer.id}</td>
            <td>${customer.name}<br>${customer.kana}</td>
            <td>${customer.email}<br>${customer.phone}</td>
            <td>${customer.company}</td>
            <td>${customer.created_at}<br>${customer.updated_at}</td>
            <td><button class="edit-button">編集</button></td>
            <td><button class="delete-button" popovertarget="my-popover">削除</button></td>
        `;
        tbody.appendChild(tr);
    });

