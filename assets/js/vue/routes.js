import AccountList from './Components/Account/AccountList.vue';
import AccountForm from './Components/Account/AccountForm.vue';

const routes = [
    { name: 'account_list', path: '/accounts', component: AccountList },
    { name: 'account_new', path: '/accounts/new', component: AccountForm },
    { name: 'account_edit', path: '/account/edit/:id', component: AccountForm },
];

export default routes;