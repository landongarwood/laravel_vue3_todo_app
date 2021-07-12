<template>
	<h1>ToDo App</h1>
	<form @submit.prevent="addTodo()">
		<label>New ToDo </label>
		<input
			v-model="newTodo"
			name="newTodo"
			autocomplete="off"
			placeholder="Press Enter to save ToDo"
		>
		<button type="button" @click="updateDataToDatabase">Save ToDo List</button>
	</form>
	<h2>ToDo List</h2>
	<ul>
		<li
			v-for="(todo, index) in todos"
			:key="index"
		>
			{{ todo.content }}
			<button @click="removeTodo(index)">Remove</button>
		</li>
	</ul>
	<h4 v-if="todos.length === 0">Empty list.</h4>
</template>

<script>
	import { ref } from 'vue';
	
	const localStorageKey = 'todos';

	export default {
		name: 'TodoList',
		setup () {
			const newTodo = ref('');
			const defaultData = [{
				content: 'Write your first ToDo Item'
			}]

			const todosData = JSON.parse(localStorage.getItem(localStorageKey)) || defaultData;
			console.log(todosData);
			const todos = ref(todosData);

			function addTodo () {
				if (newTodo.value) {
					todos.value.push({
						content: newTodo.value
					});
					newTodo.value = '';
				}
				saveData();
			}

			function removeTodo (index) {
				todos.value.splice(index, 1);
				saveData();
			}

			function saveData () {
				const storageData = JSON.stringify(todos.value);
				localStorage.setItem(localStorageKey, storageData);
			}

			function updateDataToDatabase () {
				axios.post(`/api/todo_items`, {
					todo_items: todosData,	
				})
				.then(({data: data} = response) => {
					todos.value = data.map(todo => {
						return {
							'id': todo.id,
							'content': todo.content,
						};
					});

					saveData();
				})
			}

			return {
				todos,
				newTodo,
				addTodo,
				removeTodo,
				saveData,
				updateDataToDatabase,
			}
		}
	}
</script>