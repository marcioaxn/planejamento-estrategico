<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://maxn.com.br/img/brasao.png" width="50"></a></p>

## Sistema de Gestão e Acompanhamento do Planejamento Estratégico Corporativo

Esse sistema é fruto do conhecimento adquirido em mais de 17 anos de experiência, como profissional que atuei no
acompanhamento das atividades administrativas de alguns planejamentos estratégicos ou como desenvolvedor (full stack em
um dos projetos) na manutenção/criação de sistemas corporativos de apoio gestão em planejamento estratégico.

O sistema foi desenvolvido em PHP, por meio da framework Laravel, utlizando a stack Livewire. O banco de dados utilizada
na criação e desenvolvimento foi o PostgreSQL e o Tailwind CSS como framework de estilização dos componentes HTML.

Esta versão do sistema conta com o seguinte:

- Mapa estratégico, na página inicial, que se monta conforme é feito o cadastro das perspectivas e objetivos
  estratégicos;
- Navegação sem restrição de acesso pelo Mapa estratégico, exceto para efetuar gestão sobre a administração do sistema
  ou nos indicadores de monitoramento do plano de ação, os quais precisam de login no sistema e permissão adequada;
- Menu de administração do sistema com os seguintes itens para a administração:<br />1. Unidades da Organização;<br />2.
  Usuários;<br />3. Planejamento Estratégico Integrado;<br />4. Missão, Visão e Valores;<br />5. Perspectiva;<br />6.
  Objetivo Estratégico;<br />7. Plano de Ação;<br />8. Indicadores; e<br />9. Grau de Satisfação;
- Página de login;
- Página onde o usuário cadastrado faz a gestão sobre o seu perfil;
- Página de recuperação de senha;

## Versão mínima dos itens utilizados:

<table>
<tr>
<th>Item (framework, stack, CSS, banco de dados)</th>
<th>Versão</th>
</tr>
<tr>
<td>PHP</td>
<td>7.4.3</td>
</tr>
<tr>
<td>laravel/framework</td>
<td>8.54</td>
</tr>
<tr>
<td>laravel/jetstream</td>
<td>2.4</td>
</tr>
<tr>
<td>livewire</td>
<td>2.6</td>
</tr>
<tr>
<td>TailwindCSS</td>
<td>3.0.24</td>
</tr>
<tr>
<td>PostgreSQL</td>
<td>10.20</td>
</tr>
</table>

## Procedimento de instalação do sistema

O sistema foi instalado e testado em uma ditribuição Linux (Ubuntu 20.04) e no Windows 10. Os dois com o Apache2, PHP e
o PostgreSQL instalados.

Os passos a seguir foram executados no Ubuntu 20.04:

1. No PostgreSQL crie o database com o nome de sua preferência e dentro desse database você criará dois schemas. O
   primeiro com o nome de <code>governanca</code>, mas você pode alterar esse nome, para isso entre no arquivo
   config/database.php. Esse schema será utilizado para recepcionar as tabelas utilizadas pela framework Laravel. O
   segundo schema a ser criado é o <code>pei</code>, esse schema será utilizado para recepcionar as tabelas utilizadas
   especificamente para o Planejamento Estratégico. Importante ressaltar que nesse ambiente onde fiz a instalação do
   sistema eu era no PostgreSQL o usuário com todas as permissões para criação do database, schemas e tables, no
   entanto, em um ambiente corporativo, provavelmente, será um DBA que irá executar esses procedimentos. Nesse caso.
   será importante você já tenha em mente o que precisará solicitar ao DBA. Lembre-se de anotar o nome de usuário (
   username) e a senha (password) do PostgreSQL, pois eles serão necessários para o arquivo de configuração da framework
   Laravel <code>.env</code>.
2. Próximo passo, será o clone do repositório do GitHub contendo o sistema. No diretório /var/www/html ou onde você costuma hospedar as aplicações execute o clone do sistema:
   <code>git clone https://github.com/marcioaxn/planejamento-estrategico.git</code>
3.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in
becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in
the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by
the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell
via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## Licença de uso

Esse sistema é um software de código aberto.
