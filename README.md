<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://maxn.com.br/img/brasao.png" width="50"></a></p>

## Sistema de Gestão e Acompanhamento do Planejamento Estratégico Corporativo

Esse sistema é fruto do conhecimento adquirido em mais de 17 anos de experiência, como profissional que atuei no
acompanhamento das atividades administrativas de alguns planejamentos estratégicos ou como desenvolvedor (full stack em
um dos projetos) na manutenção/criação de sistemas corporativos de apoio à gestão em planejamento estratégico.

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

## Versão mínima e links dos itens utilizados:

<table>
<tr>
<th>Item (framework, stack, CSS, banco de dados)</th>
<th>Versão</th>
<th>Link</th>
</tr>
<tr>
<td>PHP</td>
<td>7.4.3</td>
<td>https://www.php.net/</td>
</tr>
<tr>
<td>Composer</td>
<td>2.3.5</td>
<td>https://getcomposer.org/</td>
</tr>
<tr>
<td>laravel/framework</td>
<td>8.54</td>
<td>https://laravel.com/docs/8.x</td>
</tr>
<tr>
<td>laravel/jetstream</td>
<td>2.4</td>
<td>https://jetstream.laravel.com/2.x/introduction.html</td>
</tr>
<tr>
<td>livewire</td>
<td>2.6</td>
<td>https://laravel-livewire.com/</td>
</tr>
<tr>
<td>TailwindCSS</td>
<td>3.0.24</td>
<td>https://tailwindcss.com/</td>
</tr>
<tr>
<td>PostgreSQL</td>
<td>10.20</td>
<td>https://www.postgresql.org/</td>
</tr>
<tr>
<td>Chart.js</td>
<td>3.7.0</td>
<td>https://www.chartjs.org/</td>
</tr>
</table>

## Procedimento de instalação do sistema

Esse sistema foi instalado e testado em uma ditribuição Linux (Ubuntu 20.04) e no Windows 10. Sendo que nesses dois sistemas operaionais estavam instalados o Apache2, o PHP, o composer e
o PostgreSQL.

Os passos a seguir foram executados numa ditribuição Linux (Ubuntu 20.04), em um notebook com um processador I3 3ª geração e com 8gb de ram:

1. Nesse passo inicial iremos tratar das configurações do banco de dados e embora a framework Laravel nos possibilite
   trabalhar com alguns diferentes bancos de dados o escolhido nesse sistema foi o PostgreSQL. Então, no PostgreSQL crie
   o database com o nome de sua preferência e dentro desse database você deverá criar dois schemas. O primeiro schema com o nome de <code>governanca</code>, mas você pode alterar esse nome, caso queira, para isso entre no arquivo <code>
   config/database.php</code>, procure por governanca e efetue a alteração. Esse schema será utilizado para recepcionar as tabelas utilizadas pela framework Laravel e algumas construídas com o propósito de auxiliar a administração do sistema. O
   segundo schema a ser criado será o <code>pei</code>, esse schema será utilizado para recepcionar as tabelas utilizadas
   especificamente para o Planejamento Estratégico. Importante ressaltar que nesse ambiente (equipamento) onde fiz a instalação do sistema eu era no PostgreSQL o usuário com todas as permissões para a criação do database, schema e table. Em um ambiente corporativo, provavelmente, será um DBA que irá executar esses procedimentos. Nesse caso.
   será importante que você já tenha em mente o que precisará solicitar ao DBA. Lembre-se de solicitar o nome de usuário (username) e a senha (password) do PostgreSQL criados para esse sistema, pois eles serão necessários para o arquivo <code>.env</code> de configuração da framework Laravel. Outro ponto importante a se ressaltar é o tipo de permissão de usuário que irá solicitar ao DBA. Para que a instalação tenha êxito é necessário que o usuário do PostgreSQL tenha permissão para criar tabela, levando-se em consideração que a permissão será concedida em um ambiente de desenvolvimento ou de homologação e não de produção, por questão de segurança e integridade do banco de dados.


2. O próximo passo será fazer o clone do do sistema que está no repositório do GitHub. Utilizando o terminal do Ubuntu e no diretório <code>/var/www/html</code> ou onde você
   costuma hospedar as aplicações WEB execute o clone do sistema com o seguinte comando:


   <code>git clone https://github.com/marcioaxn/planejamento-estrategico.git</code>


3. Agora com o clone do sistema já no seu ambiente é o momento de criar a pasta <code>vendor</code>. Essa é a pasta utilizada pela framework Laravel para recepcionar todas as dependẽncias necessárias para o bom funcionamento da arquitetura do sistema. Ainda utilizando o terminal do Ubuntu e agora no diretório raiz do sistema, por exemplo, <code>/var/www/html/planejamento-estrategico</code>, execute o seguinte comando:

<code>composer update</code>

Nesses anos de experiência percebi que, geralmente, esse comando demora um pouco para ser finalizado. Ao executá-lo, por exemplo, num servidor da Digital Ocean, localizado em New York, esse comando é finalizado em questão de segundos, mas, aqui no notebook esse tempo vai para uns cinco minutos em média. Então, caso esteja demorando para finalizar tenha um pouco de paciência.

4. Na sequencia o próximo passo será fazer uma cópia do arquivo <code>.env.example</code> que terá o nome de <code>.env</code>. Ainda por meio do terminal e ainda no diretório raiz do sistema execute o seguinte comando.

<code>sudo cp .env.example .env</code>

Agora com o arquivo de configuração do sistema criado iremos adequá-lo alterando o conteúdo de algumas variáveis conforme veremos a seguir:

4.1. <code>APP_NAME="Nome do Sistema"</code>
Essa variável receberá o nome do sistema ou o nome do projeto. Nesse exemplo coloquei entre aspas duplas pois, dessa forma, poderá ter espaços entre as palavras ou letras com acentuação.

4.2. No ambiente de desenvolvimento e de homologação estas duas variáveis <code>APP_ENV</code> e <code>APP_DEBUG</code> poderão permanecer da forma como estão, mas, num ambiente de produção é necessário que elas sejam alteradas, por segurança, conforme a seguir:

<code>APP_ENV=production</code>

<code>APP_DEBUG=false</code>

4.3. Esta variável <code>APP_URL</code> precisa conter o real endereço (url) de acesso ao sistema. A stack Livewire, devido 

## Licença de uso

Esse é um software de código aberto (open source).
