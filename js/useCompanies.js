import { companies } from './companies.js';

        const selectElement = document.getElementById('company');

        companies.forEach(company => {
            const option = document.createElement('option');
            option.value = company.id;
            option.textContent = company.name;
            selectElement.appendChild(option);//optionを子要素として追加する
        });