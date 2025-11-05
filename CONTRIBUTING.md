# Guia de Contribuição

Obrigado por considerar contribuir para o CMS da Rica Soluções! Este documento contém diretrizes para contribuir com o projeto.

## Sumário

- [Código de Conduta](#código-de-conduta)
- [Como Começar](#como-começar)
- [Processo de Desenvolvimento](#processo-de-desenvolvimento)
- [Padrões de Código](#padrões-de-código)
- [Testes](#testes)
- [Commits](#commits)
- [Pull Requests](#pull-requests)

## Código de Conduta

Este projeto adere ao código de conduta da Rica Soluções. Ao participar, você concorda em seguir suas diretrizes.

## Como Começar

### Fork e Clone

1. Faça um fork do repositório
2. Clone seu fork localmente:
   ```bash
   git clone https://github.com/seu-usuario/cms.git
   cd cms
   ```

### Instalação

1. Instale as dependências:
   ```bash
   composer install
   ```

2. Configure o ambiente de testes:
   ```bash
   cp .env.example .env.testing
   ```

### Verificar Instalação

Execute os testes para garantir que tudo está funcionando:

```bash
composer test
```

## Processo de Desenvolvimento

### 1. Criar uma Branch

Sempre crie uma branch a partir da `develop`:

```bash
git checkout develop
git pull origin develop
git checkout -b feature/minha-feature
```

**Nomenclatura de branches:**
- `feature/nome-da-feature` - Nova funcionalidade
- `fix/nome-do-bug` - Correção de bug
- `docs/nome-da-doc` - Documentação
- `refactor/nome-do-refactor` - Refatoração
- `test/nome-do-teste` - Adicionar/melhorar testes

### 2. Desenvolver

- Escreva código limpo e legível
- Siga os padrões de código (PSR-12)
- Adicione testes para novas funcionalidades
- Atualize a documentação quando necessário

### 3. Testar

Antes de commitar, execute:

```bash
# Verificar code style
composer format-check

# Executar análise estática
composer psalm
composer phpstan

# Executar testes
composer test

# Ou executar todas as verificações de uma vez
composer check
```

### 4. Commit

Faça commits pequenos e frequentes com mensagens claras:

```bash
git add .
git commit -m "feat: add user authentication"
```

### 5. Push e Pull Request

```bash
git push origin feature/minha-feature
```

Abra um Pull Request para a branch `develop` no repositório original.

## Padrões de Código

### PSR-12

O projeto segue o padrão PSR-12. Use o PHP-CS-Fixer para garantir conformidade:

```bash
# Verificar
composer format-check

# Corrigir automaticamente
composer format
```

### Convenções de Nomenclatura

#### Classes

```php
// Controllers
class BlogController extends Controller {}

// Services
class BlogService {}

// Repositories
class BlogRepository {}

// Models
class Post extends Model {}
```

#### Métodos

```php
// camelCase
public function createPost() {}
public function findBySlug(string $slug) {}
```

#### Variáveis

```php
// camelCase
$userId = 1;
$postTitle = 'My Post';
```

### Type Hints e Return Types

Sempre use type hints e declare return types:

```php
public function createPost(array $data): Post
{
    // ...
}

public function findById(int $id): ?Post
{
    // ...
}

public function getPosts(): Collection
{
    // ...
}
```

### DocBlocks

Documente métodos públicos:

```php
/**
 * Create a new blog post
 *
 * @param array $data Post data including title, content, etc.
 * @return \Cms\Models\Blog\Post
 * @throws \InvalidArgumentException When required data is missing
 */
public function createPost(array $data): Post
{
    // ...
}
```

## Testes

### Estrutura de Testes

```
tests/
├── Unit/           # Testes unitários
│   ├── Models/
│   ├── Services/
│   └── Repositories/
└── Feature/        # Testes de integração
    └── Http/
        └── Controllers/
```

### Escrever Testes

```php
namespace Tests\Feature;

use Tests\TestCase;
use Cms\Models\Blog\Post;

class BlogTest extends TestCase
{
    /** @test */
    public function it_can_create_a_post()
    {
        $post = Post::create([
            'title' => 'Test Post',
            'slug' => 'test-post',
            'content' => 'Test content',
        ]);

        $this->assertDatabaseHas('posts', [
            'slug' => 'test-post',
        ]);

        $this->assertEquals('Test Post', $post->title);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $this->expectException(\InvalidArgumentException::class);

        Post::create([
            // Missing required 'title'
            'content' => 'Test content',
        ]);
    }
}
```

### Executar Testes

```bash
# Todos os testes
composer test

# Com cobertura
composer test-coverage

# Testes específicos
./vendor/bin/phpunit --filter BlogTest

# Testes de uma pasta específica
./vendor/bin/phpunit tests/Unit
```

### Cobertura de Testes

O projeto exige **mínimo 80% de cobertura**. Verifique a cobertura:

```bash
composer test-coverage
# Abra coverage/index.html no navegador
```

## Commits

### Conventional Commits

Seguimos o padrão [Conventional Commits](https://www.conventionalcommits.org/):

**Formato:**
```
<type>: <description>

[optional body]

[optional footer]
```

**Types:**
- `feat:` - Nova funcionalidade
- `fix:` - Correção de bug
- `docs:` - Documentação
- `style:` - Formatação (não afeta código)
- `refactor:` - Refatoração
- `test:` - Adicionar/corrigir testes
- `chore:` - Manutenção
- `perf:` - Melhoria de performance
- `ci:` - CI/CD
- `build:` - Build system

**Exemplos:**

```bash
# Feature
git commit -m "feat: add user profile page"

# Bug fix
git commit -m "fix: resolve slug duplication in posts"

# Documentation
git commit -m "docs: update installation guide"

# Refactoring
git commit -m "refactor: improve BlogService performance"

# Test
git commit -m "test: add tests for PageRepository"

# Breaking change
git commit -m "feat!: redesign authentication system

BREAKING CHANGE: Authentication now uses tokens instead of sessions"
```

### Mensagens de Commit

- Use o imperativo: "add" não "added" ou "adds"
- Primeira linha com no máximo 50 caracteres
- Deixe uma linha em branco antes do corpo (se houver)
- Corpo com no máximo 72 caracteres por linha
- Explique o "porquê" não o "o quê"

**Bom:**
```
feat: add caching to post queries

Post queries were slow on large datasets. This adds
Redis caching with automatic invalidation when posts
are created or updated.

Closes #123
```

**Ruim:**
```
update files
```

## Pull Requests

### Antes de Abrir um PR

1. ✅ Verifique se todos os testes passam
2. ✅ Verifique o code style
3. ✅ Execute análise estática
4. ✅ Atualize a documentação se necessário
5. ✅ Adicione entrada no CHANGELOG.md

```bash
composer check
```

### Template de PR

Use o template abaixo para criar seu PR:

```markdown
## Descrição

Breve descrição das mudanças.

## Tipo de Mudança

- [ ] Bug fix (correção que resolve um issue)
- [ ] Nova feature (funcionalidade que adiciona algo novo)
- [ ] Breaking change (correção ou feature que quebra compatibilidade)
- [ ] Documentação

## Como Testar

1. Vá para '...'
2. Clique em '...'
3. Veja resultado

## Checklist

- [ ] Meu código segue o estilo do projeto
- [ ] Executei self-review do meu código
- [ ] Comentei código complexo
- [ ] Atualizei a documentação
- [ ] Minhas mudanças não geram novos warnings
- [ ] Adicionei testes que provam que minha correção/feature funciona
- [ ] Testes unitários novos e existentes passam localmente
- [ ] Atualizei o CHANGELOG.md

## Issues Relacionadas

Fixes #123
Closes #456
```

### Code Review

Todos os PRs passam por code review. Espere:

1. ✅ Testes automatizados (CI/CD) passarem
2. ✅ Aprovação de pelo menos 1 maintainer
3. ✅ Resolução de todos os comentários

### Após Aprovação

Seu PR será mergeado por um maintainer. Depois:

1. Atualize sua branch local:
   ```bash
   git checkout develop
   git pull origin develop
   ```

2. Delete sua branch local:
   ```bash
   git branch -d feature/minha-feature
   ```

## Versionamento

O projeto segue [Semantic Versioning 2.0.0](https://semver.org/):

- **MAJOR** (X.0.0): Breaking changes
- **MINOR** (0.X.0): Novas features (compatível)
- **PATCH** (0.0.X): Bug fixes (compatível)

## Reportar Bugs

Use o [Issue Tracker](https://github.com/ricasolucoes/cms/issues) para reportar bugs.

**Template de Bug Report:**

```markdown
**Descrição do Bug**
Descrição clara e concisa do bug.

**Para Reproduzir**
Passos para reproduzir:
1. Vá para '...'
2. Clique em '...'
3. Veja o erro

**Comportamento Esperado**
Descrição do que deveria acontecer.

**Screenshots**
Se aplicável, adicione screenshots.

**Ambiente:**
 - OS: [ex: Ubuntu 20.04]
 - PHP: [ex: 8.1]
 - Laravel: [ex: 9.0]
 - CMS Version: [ex: 1.2.3]

**Informações Adicionais**
Qualquer outra informação relevante.
```

## Solicitar Features

Use o [Issue Tracker](https://github.com/ricasolucoes/cms/issues) para solicitar features.

**Template de Feature Request:**

```markdown
**Descrição da Feature**
Descrição clara e concisa da feature solicitada.

**Motivação**
Por que esta feature é necessária? Que problema ela resolve?

**Solução Proposta**
Como você imagina que a feature funcione?

**Alternativas Consideradas**
Outras soluções que você considerou?

**Informações Adicionais**
Qualquer outra informação, contexto ou screenshots.
```

## Obter Ajuda

- 📧 Email: help@ricasolucoes.com.br
- 💬 Slack: [Rica Soluções Community](https://ricasolucoes.slack.com)
- 🌐 Forum: [community.ricasolucoes.com](https://community.ricasolucoes.com)

## Licença

Ao contribuir, você concorda que suas contribuições serão licenciadas sob a [MIT License](LICENSE).

---

**Obrigado por contribuir! 🎉**
