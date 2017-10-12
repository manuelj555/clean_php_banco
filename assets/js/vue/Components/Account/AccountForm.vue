<template>
    <div>
        <div class="row">
            <form action="#" @submit.prevent="submitForm">
                <div class="form-group">
                    <label>Account Number</label>
                    <input type="text" :value="account.id" readonly class="form-control">
                </div>

                <div class="form-group">
                    <label>Account Balance</label>
                    <div class="input-group">
                        <span class="input-group-addon">{{ account.balance.currency }}</span>
                        <input type="text" :readonly="!isNew" v-model="account.balance.amount" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>Client Email</label>
                    <input type="email" v-model="account.client.email" class="form-control">
                </div>

                <div class="form-group">
                    <label>Client Address</label>
                    <textarea v-model="account.client.address" class="form-control"></textarea>
                </div>
                <!--{{ account }}-->

                <div class="form-actions text-right">
                    <input type="submit" value="Save" class="btn btn-success"/>
                    <router-link class="btn btn-default" :to="{ name: 'account_list' }">Cancel</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                account: this.getEmptyAccount(),
            }
        },

        computed: {
            isNew () {
                return this.$route.params.id == null;
            },
        },

        created () {
            this.resource = this.$resource('account/{id}');

            if (!this.isNew) {
                this.loadAccount(this.$route.params.id).then(account => this.account = account);
            } else {
                this.account = this.getEmptyAccount();
            }
        },

        methods: {

            loadAccount (id) {
                return this.resource.get({id}).then(data => {
                    return data.body;
                });
            },

            submitForm() {
                this.save(this.account).then((account) => {
                    this.$router.push({name: 'account_edit', params: {id: account.id}});
                });
            },

            getEmptyAccount () {
                return {
                    id: null,
                    client: {
                        email: null,
                        address: null,
                    },
                    balance: {
                        currency: null,
                        amount: null,
                    },
                };
            },

            save(account) {
                if (this.isNew) {
                    return this.resource.save({}, account).then(response => {
                        alert('Done!');

                        return response.body;
                    });
                } else {
                    return this.resource.update({id: account.id}, account).then(response => {
                        alert('Done!');

                        return response.body;
                    });
                }
            }

        },
    }
</script>