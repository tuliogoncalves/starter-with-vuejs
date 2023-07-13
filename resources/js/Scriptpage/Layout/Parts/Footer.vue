<template>

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="float-right d-none d-sm-inline">v{{ this.$page.props.flash.versions.scriptpage }}</div>
		<!-- Default to the left -->
		<strong>
			Copyright &copy; 2016-2023
			<a href="https://scriptpage.com.br">Scriptpage Tecnologias</a>.
		</strong>
		All rights reserved.
	</footer>
    
</template>

<script>
	export default {
		name: "Footer",
	};
</script>
