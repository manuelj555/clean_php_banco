<template>
    <div>
        <form action="#" @submit.prevent="submitForm">
            <div class="form-group">
                <label>Account Number</label>
                <input type="text" :value="account.id" readonly class="form-control">
            </div>

            <div class="form-group">
                <label>Account Balance</label>
                <div class="input-group" :class="{'is-invalid': errors.has('balance')}">
                    <span class="input-group-addon">{{ account.balance.currency }}</span>
                    <input type="text" name="balance" :readonly="!isNew" v-model="account.balance.amount"
                           class="form-control" v-validate="'required|decimal'">
                </div>
                <form-errors :errors="errors.collect('balance')"/>
            </div>

            <div class="form-group">
                <label>Client Email</label>
                <input type="email" name="email" v-model="account.client.email" class="form-control"
                       v-validate="'required|email'">
                <form-errors :errors="errors.collect('email')"/>
            </div>

            <div class="form-group">
                <label>Client Address</label>
                <textarea name="address" v-model="account.client.address" class="form-control"
                          v-validate="'required'"></textarea>
                <form-errors :errors="errors.collect('address')"/>
            </div>
            <!--{{ account }}-->

            <div class="form-actions text-right">
                <input type="submit" value="Save" class="btn btn-success"/>
                <router-link class="btn btn-dark" :to="{ name: 'account_list' }">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
    import FormErrors from '../FormErrors.vue';

    export default {
        data () {
            return {
                account: this.getEmptyAccount(),
            }
        },

        components: {
            FormErrors,
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
                        currency: 'Bs',
                        amount: null,
                    },
                };
            },

            save(account) {
                return this.$validator.validateAll().then((result) => {
                    if (!result) {
                        return;
                    }

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
                });
            }

        },
    }
</script>