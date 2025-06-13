📌 **Tema:** Catálogo de Filmes

🎓 **Aluno:**

* Maycon M. Zanyck [8138657961]

📝 **Resumo do Funcionamento:**
Este sistema permite que o usuário se cadastre, faça login e gerencie um catálogo de filmes pessoais. Cada usuário pode adicionar, editar e excluir seus próprios filmes com título e descrição.

📦 **Instalação:**

1. Acesse o phpMyAdmin e crie um banco de dados com o nome: `catalogo_filmes`
2. Execute o seguinte script SQL:

```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);
```

3. Configure os dados de conexão no arquivo `includes/conexao.php`
4. Copie a pasta do projeto para `htdocs/catalogo-filmes` no XAMPP
5. Inicie o Apache e o MySQL no painel do XAMPP
6. Acesse no navegador: [http://localhost/catalogo-filmes/]
7. Crie um usuário usando o formulário de cadastro

✅ **Pronto!**