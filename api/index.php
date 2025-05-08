<?php
$title = "Todo List SPA (LocalStorage)";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h1 class="text-center mb-4"><?= $title ?></h1>
  
  <div class="input-group mb-3">
    <input type="text" id="todoInput" class="form-control" placeholder="Tambah aktivitas...">
    <button class="btn btn-primary" onclick="addTodo()">Tambah</button>
  </div>
  
  <ul id="todoList" class="list-group"></ul>
</div>

<script>
let todos = [];

function loadTodos() {
  const data = localStorage.getItem('todos');
  todos = data ? JSON.parse(data) : [];
  renderTodos();
}

function saveTodos() {
  localStorage.setItem('todos', JSON.stringify(todos));
}

function renderTodos() {
  const list = document.getElementById('todoList');
  list.innerHTML = '';
  todos.forEach((todo, index) => {
    list.innerHTML += `
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span contenteditable="true" onblur="editTodo(${index}, this.innerText)">${todo}</span>
        <button class="btn btn-danger btn-sm" onclick="deleteTodo(${index})">Hapus</button>
      </li>`;
  });
}

function addTodo() {
  const input = document.getElementById('todoInput');
  const text = input.value.trim();
  if (text) {
    todos.push(text);
    input.value = '';
    saveTodos();
    renderTodos();
  }
}

function deleteTodo(index) {
  todos.splice(index, 1);
  saveTodos();
  renderTodos();
}

function editTodo(index, text) {
  todos[index] = text.trim();
  saveTodos();
}

document.addEventListener('DOMContentLoaded', loadTodos);
</script>
</body>
</html>
