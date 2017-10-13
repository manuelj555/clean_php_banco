<template>
	<div class="invalid-feedback" :class="{'d-block': hasErrors}">
		<ul>
			<li v-for="error in errors">{{ error }}</li>
		</ul>
    </div>
</template>

<script>
	export default {
		props: ['errors'],

		computed: {
		    hasErrors() {
		        return this.errors && this.errors.length > 0;
			},
		},

		data () {
			return {

			};
		},
	}
</script>