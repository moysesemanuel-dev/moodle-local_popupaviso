# 📌 Plugin Popup de Aviso — Moodle (local_popupaviso)
O Popup de Aviso é um plugin local para Moodle que permite criar, gerenciar e exibir pop-ups personalizados para usuários, com filtros por URL, papéis (roles) e limite de exibição por sessão. Ele é ideal para:

avisos institucionais

comunicados importantes

alertas de manutenção

mensagens direcionadas a grupos específicos

exibição de vídeos informativos (YouTube)

O plugin foi desenvolvido seguindo os padrões do Moodle e é compatível com Moodle 4.0 ou superior.

# ✅ Funcionalidades
✅ Exibição automática de pop-ups
Os pop-ups são exibidos automaticamente antes do rodapé da página, usando o hook before_footer.

##✅ Filtros avançados
Por URL Exibe o popup apenas em páginas específicas.

Por papel (role) Suporte a: student, teacher, manager.

Por limite de exibição Controla quantas vezes o popup aparece por sessão do navegador.

# ✅ Conteúdo rico
Mensagem em HTML

Suporte a vídeo do YouTube

Cor de fundo personalizada

Botão de fechar com controle de sessão

# ✅ Administração completa
Criar, editar e excluir pop-ups

Listagem com resumo das mensagens

Interface amigável usando MoodleForms

Página dedicada no menu de administração

# ✅ Armazenamento em tabela própria
O plugin cria a tabela:

Código
local_popupaviso_popups
Com campos como: nome, mensagem, URL, vídeo, cor, limite, ativo, papel-alvo, timestamps etc.

# ✅ Instalação
Baixe ou clone o plugin para:

Código
moodle/local/popupaviso
Acesse o Moodle como administrador.

O Moodle detectará o plugin automaticamente.

Siga o processo de instalação.

# ✅ Atualização
O plugin inclui um arquivo upgrade.php que gerencia atualizações de versão. Ao atualizar o código:

Acesse Administração do site → Notificações

O Moodle executará automaticamente as migrações necessárias.

##✅ Configuração
Após instalar:

Acesse Administração do site → Plugins → Plugins locais → Popup de Aviso

Você verá a página:

Código
Gerenciar Pop-ups
Nela é possível:

Criar novos pop-ups

Editar existentes

Excluir pop-ups

Ver lista completa

# ✅ Como funciona a exibição dos pop-ups
A classe:

Código
classes/hook_callbacks.php
executa o método:

Código
hook_callbacks::before_footer()
Esse método:

Busca todos os pop-ups ativos

Verifica o papel do usuário

Verifica a URL atual

Aplica o limite de exibição por sessão

Renderiza o popup usando:

Código
util::render_popup($popup)
O popup é exibido com:

HTML formatado

CSS inline

JavaScript para controle de sessão

Vídeo do YouTube (opcional)

# ✅ Estrutura da tabela (install.xml)
A tabela local_popupaviso_popups contém:

Campo	Tipo	Descrição
id	int	Chave primária
name	char(255)	Nome do popup
url	text	URL alvo
mensagem	text	Conteúdo HTML
video	char(255)	Link do YouTube
cor	char(7)	Cor de fundo
limite	int	Limite por sessão
active	int(1)	Ativo/inativo
timecreated	int	Timestamp
timemodified	int	Timestamp
targetrole	char(50)	Papel alvo
# ✅ Permissões
O plugin define a capability:

Código
local/popupaviso:view
Por padrão, apenas manager tem permissão.

# ✅ Estrutura do plugin
Código
local/popupaviso/
├── admin/
│   ├── manage.php
│   ├── edit.php
│   ├── delete.php
│   └── forms.php
├── classes/
│   ├── hook_callbacks.php
│   └── util.php
├── db/
│   ├── install.xml
│   └── upgrade.php
├── lang/
│   ├── en/local_popupaviso.php
│   └── pt_br/local_popupaviso.php
├── settings.php
├── version.php
├── lib.php
└── styles.css
# ✅ Licença
Este plugin é distribuído sob a licença GNU GPL v3, compatível com o Moodle.

# ✅ Créditos
Desenvolvido por Moyses Costa, 2025.

![Moodle Plugin](https://img.shields.io/badge/Moodle-Local%20Plugin-2a7fff)
![Moodle Version](https://img.shields.io/badge/Moodle-4.0%2B-blue)
![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777bb4)
![License: GPL v3](https://img.shields.io/badge/License-GPLv3-green)
![Status](https://img.shields.io/badge/Status-Estável-success)
![Release](https://img.shields.io/badge/Release-1.0.0-blueviolet)
