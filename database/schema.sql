CREATE TABLE usuarios (id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT NOT NULL, email TEXT NOT NULL UNIQUE, senha TEXT NOT NULL, criado_em TEXT DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE produtos (id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT NOT NULL, categoria TEXT NOT NULL, preco REAL NOT NULL, descricao TEXT, icone TEXT, cor TEXT);
CREATE TABLE pedidos (id INTEGER PRIMARY KEY AUTOINCREMENT, usuario_id INTEGER NOT NULL, total REAL NOT NULL, criado_em TEXT DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE itens_pedido (id INTEGER PRIMARY KEY AUTOINCREMENT, pedido_id INTEGER NOT NULL, produto_id INTEGER NOT NULL, quantidade INTEGER NOT NULL, preco REAL NOT NULL);
INSERT INTO produtos (nome,categoria,preco,descricao,icone,cor) VALUES
('Tênis de Corrida Velox','Corrida',399.90,'Amortecimento leve para treinos longos e provas de rua.','👟','#FF5A1F'),
('Camisa de Time Titular','Futebol',249.90,'Tecido respirável com secagem rápida. Modelo torcedor.','👕','#1B7F4B'),
('Bola de Futebol Campo Pro','Futebol',179.90,'Costura térmica, mais precisão e durabilidade no gramado.','⚽','#14213D'),
('Bola de Basquete Street','Basquete',159.90,'Borracha de alta aderência para quadras externas.','🏀','#C2410C'),
('Bermuda de Treino Flex','Academia',89.90,'Cintura elástica e tecido que acompanha o movimento.','🩳','#475569'),
('Luvas de Treino Grip','Academia',69.90,'Proteção nas palmas para barra, anilhas e halteres.','🧤','#7C3AED'),
('Raquete de Tênis Ace','Tênis',529.90,'Equilíbrio na cabeça e boa potência para jogo de fundo.','🎾','#0F766E'),
('Garrafa Térmica 750ml','Acessórios',59.90,'Mantém a água gelada por até 12 horas.','🥤','#0369A1'),
('Mochila Esportiva 30L','Acessórios',139.90,'Compartimento para tênis e bolso térmico lateral.','🎒','#B45309'),
('Bicicleta Aro 29 Trail','Ciclismo',2199.00,'Quadro de alumínio, 21 marchas e freio a disco.','🚴','#DC2626'),
('Capacete de Ciclismo Air','Ciclismo',219.90,'Ventilação ampliada e ajuste fácil na nuca.','⛑️','#EAB308'),
('Óculos de Natação Aqua','Natação',49.90,'Lentes antiembaçantes com proteção UV.','🥽','#0891B2');
