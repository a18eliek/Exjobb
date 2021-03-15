<template>
	<div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center">
		{{message}}
	</div>
</template>
<script>
const default_layout = "default";

export default {
	computed: {},
	data() {
			return {
					message:'Hello from Vue.js!'
			}
	}
};
</script>