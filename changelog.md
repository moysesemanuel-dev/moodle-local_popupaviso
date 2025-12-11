# Changelog — Plugin local_popupaviso

Todas as mudanças relevantes deste projeto serão documentadas neste arquivo.

O formato segue as recomendações de [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/) e o versionamento segue o padrão [Semantic Versioning](https://semver.org/lang/pt-BR/).

---

## [1.0.0] — 2025-07-07
### Adicionado
- Primeira versão estável do plugin.
- Sistema completo de pop-ups configuráveis.
- Suporte a mensagens em HTML.
- Suporte a vídeos do YouTube incorporados.
- Filtro por URL para exibição condicional.
- Filtro por papéis (student, teacher, manager).
- Limite de exibição por sessão do navegador.
- CRUD completo no painel administrativo:
  - Criar pop-up
  - Editar pop-up
  - Excluir pop-up
  - Listar pop-ups
- Página administrativa integrada ao menu de plugins locais.
- Tabela `local_popupaviso_popups` criada via `install.xml`.
- Hook `before_footer` para exibição automática dos pop-ups.
- Renderização com CSS e JavaScript embutidos.
- Suporte a ativação/desativação de pop-ups.
- Sistema de permissões com capability `local/popupaviso:view`.

---

## [0.1.0] — 2025-06-15
### Adicionado
- Protótipo inicial do plugin.
- Testes de renderização básica de pop-up.
- Estrutura inicial de classes e arquivos.
