<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Посты</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
</head>
<body class="bg-dark text-white-50">
	<!-- header -->
	<div class="bg-secondary col-12" style="height: 60px;">
		<div class="col-10 mx-auto" style="height: 60px;">
		</div>
	</div>
	<!-- main -->
	<div class="col-6 mx-auto">
		<div id="app">
			<!-- create post -->
			<div class="col-12">
				<h5>Создать пост</h5>
				<?= csrf_field(); ?>
				<div class="my-3">
					<input class="form-control bg-dark text-white-50" v-model="post.title" type="text" placeholder="Введите заголовок">
				</div>
				<div class="my-3">
					<textarea class="form-control bg-dark text-white-50" rows="3" v-model="post.text" placeholder="Введите текст"></textarea>
				</div>
				<div class="my-3">
					<button class="btn btn-primary" v-on:click="createPost">Создать</button>
				</div>
			</div>
			<div v-for="post in posts" class="col-12">
				<h4 class="my-3">@{{ post.title }}</h4>
				<p class="my-3">@{{ post.text }}</p>
				<p class="my-3"><span style="font-weight: bold;">ID: </span>@{{ post.id }}</p>
				<!-- delete -->
				<div  class="my-3">
					<?= csrf_field(); ?>
					<button class="btn btn-danger" v-on:click="deletePost(post.id)">Удалить</button>
				</div>
				<!-- update -->
				<div>
					<?= csrf_field(); ?>
					<input type="hidden" v-model="post.id">
					<input type="text" class="form-control my-3 bg-dark text-white-50" v-model="post.title">
					<textarea class="form-control my-3 bg-dark text-white-50" rows="3" placeholder="Введите текст" v-model="post.text"></textarea>
					<button class="btn btn-success mb-3" v-on:click="updatePost(post.id, post.title, post.text)">Обновить</button>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script>
		let app = new Vue({
			el: '#app',
			data: {
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
					console.log('Mounted вызывается!');
					axios.get('/show')
						.then(response => {
							this.posts = response.data;
							console.log('Mounted вызывается!');
						})
						.catch(error => console.log(error));			
				},
				createPost: function() {
					console.log('Функция createPost вызывается!');
					axios.post('/insert', {
							title: this.post.title,
							text: this.post.text
						})
						.then(response => {
							this.getPosts();
						})
						.catch(error => console.log(error));
				},
				deletePost: function(id) {
					console.log('Функция deletePost вызывается!');
					axios.post('/delete', {
							id: id
						})
						.then(response => {
							this.getPosts();
						})
						.catch(error => console.log(error));
				},
				updatePost: function(id, title, text) {
					console.log('Функция updatePost вызывается!');
					axios.post('/update', {
							id: id,
							title: title,
							text: text
						})
						.then(response => {
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