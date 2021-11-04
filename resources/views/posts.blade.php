<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Посты</title>
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>
<body>
	<div id="app">
		@{{ name + ' ' + surname}}
		<button v-on:click="createPost">Создать</button>
		<button v-on:click="deletePost">Удалить</button>
		<button v-on:click="updatePost">Обновить</button>
		<div class="box" style="height: 100px; width: 100px; background-color: red;"></div>
		<div>
			<?= csrf_field(); ?>
			<input v-model="post.title" type="text" placeholder="Заголовок">
			<input v-model="post.text" type="text" placeholder="Текст">
			<button v-on:click="createPost">Создать</button>
		</div>
		<div v-for="post in posts">
			<h1>@{{ post.title }}</h1>
			<p>@{{ post.text }}</p>
			<p><span style="font-weight: bold;">ID: </span>@{{ post.id }}</p>
			<div>
				<?= csrf_field(); ?>
				<button v-on:click="deletePost(post.id)">Удалить</button>
			</div>
			<div>
				<?= csrf_field(); ?>
				<input type="text" v-model="post.id">
				<input type="text" v-model="post.title">
				<input type="text" v-model="post.text">
				<button v-on:click="updatePost(post.id, post.title, post.text)">Обновить</button>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script>
		let app = new Vue({
			el: '#app',
			data: {
				name: 'Anya',
				surname: 'Arutkina',
				posts: [],
				post: {
					id: '',
					title: '',
					text: ''
				}
			},
			mounted: function() {
				this.getPosts();
			},
			methods: {
				getPosts: function() {
					alert('Mounted вызывается!');
					axios.get('/show')
						.then(response => {
							this.posts = response.data;
							console.log(this.posts);
							console.log('Mounted вызывается!');
						})
						.catch(error => console.log(error));			
				},
				createPost: function() {
					console.log('Функция createPost вызывается!');
					let box = document.querySelector('.box');
					box.style.backgroundColor = 'green';

					axios.post('/insert', {
							title: this.post.title,
							text: this.post.text
						})
						.then(response => {
							console.log(response);
							this.getPosts();
						})
						.catch(error => console.log(error));
				},
				deletePost: function(id) {
					console.log('Функция deletePost вызывается!');
					let box = document.querySelector('.box');
					box.style.backgroundColor = 'orange';

					axios.post('/delete', {
							id: id
						})
						.then(response => {
							console.log(response);
							this.getPosts();
						})
						.catch(error => console.log(error));
				},
				updatePost: function(id, title, text) {
					console.log('Функция updatePost вызывается!');
					let box = document.querySelector('.box');
					box.style.backgroundColor = 'yellow';

					axios.post('/update', {
							id: id,
							title: title,
							text: text
						})
						.then(response => {
							console.log(response);
							console.log(this.post.id + ' ' + this.post.title + ' ' + this.post.text);
							this.getPosts();
						})
						.catch(error => console.log(error));
				}
			}
		});
	</script>
</body>
</html>