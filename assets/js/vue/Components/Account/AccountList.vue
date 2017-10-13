<template>
    <div>

        <router-link class="btn btn-primary" :to="{ name: 'account_new' }">Create new Account</router-link>

        <!--<div class="row">-->
            <!--<div class="col-sm-6" v-for="account in accounts">-->

                <!--<div class="card">-->
                    <!--&lt;!&ndash;<img class="card-img-top" src="" alt="Card image cap">&ndash;&gt;-->
                    <!--<div class="card-body">-->
                        <!--<h4 class="card-title">{{ account.client.email }}</h4>-->
                        <!--<div class="card-text">-->
                            <!--<ul>-->
                                <!--<li><b>Amount:</b>{{ account.balance.currency }} {{ account.balance.amount }}</li>-->
                            <!--</ul>-->
                        <!--</div>-->

                        <!--<router-link class="btn btn-default" :to="{ name: 'account_edit', params: {id: account.id} }">Edit</router-link>-->
                    <!--</div>-->
                <!--</div>-->

            <!--</div>-->
        <!--</div>-->

        <div class="d-flex flex-wrap">
            <div class="p-1 col-sm-4" v-for="account in accounts">
                <div class="card" style="height: 100%">
                    <!--<img class="card-img-top" src="" alt="Card image cap">-->
                    <div class="card-body">
                        <h4 class="card-title">{{ account.client.email }}</h4>
                        <div class="card-text">
                            <ul>
                                <li><b>Amount:</b>{{ account.balance.currency }} {{ account.balance.amount }}</li>
                            </ul>
                        </div>

                        <router-link class="btn btn-dark" :to="{ name: 'account_edit', params: {id: account.id} }">Edit</router-link>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data () {
            return {
                accounts: [],
            }
        },

        created () {
            this.getAccounts().then(accounts => this.accounts = accounts);
        },

        methods: {

            getAccounts () {
                return this.$http.get('account/').then(data => {
                    return data.body;
                });
            }

        },
    }
</script>