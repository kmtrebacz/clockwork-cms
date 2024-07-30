<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* base.twig */
class __TwigTemplate_3ef0f6d3742a98adf049bcc522d0bf2b extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'css' => [$this, 'block_css'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
     <head>
          <meta charset=\"UTF-8\" />
          <meta
               name=\"viewport\"
               content=\"width=device-width, initial-scale=1.0\"
          />
          <title>Clockwork Admin - ";
        // line 9
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>
          <style>
               :root {
                    --primary-color: #ff661f;
                    --primary-light: #ff8b4d;
                    --primary-dark: #cc5200;

                    --success-color: #28A745;
                    --error-color: #DC3545;

                    --background-color: #F4F4F9;
                    --text-color: #333333;
                    --muted-color: #6C757D;
                    --border-color: #E0E0E0;
               }

\t\t\t* {
                    padding: 0;
\t\t\t\tmargin: 0;
                    transition: 0.2s;
\t\t\t}

               body {
                    font-family: Arial, sans-serif;
                    font-size: 16px;
                    background-color: var(--background-color);
                    color: var(--text-color);
               }

               .container {
                    display: flex;
                    height: 100vh;
               }

               nav {
                    background-color: var(--text-color);
                    color: var(--background-color);
                    width: 12em;
                    height: 100vh;
                    position: fixed;
                    top: 0;
                    left: 0;
               }

\t\t\tnav > ul {
\t\t\t\tlist-style: none;
\t\t\t}

               nav > ul > li {
                    padding: 0.7em;
                    cursor: pointer;
               }

               nav > ul > li:hover {
                    background-color: var(--primary-light);
               }

               nav > ul > li.active {
                    background-color: var(--primary-color);
               }

               nav > ul > li.active:hover {
                    background-color: var(--primary-dark);
               }

               nav > ul > li > i {
                    margin-right: 0.7em;
               }

               main {
                    ";
        // line 79
        if (($context["nav"] ?? null)) {
            // line 80
            yield "                         width: calc(100% - 12em);
                    ";
        } else {
            // line 82
            yield "                         width: 100%;
                    ";
        }
        // line 84
        yield "                    height: max-content;
                    margin-left: 12em;
                    padding: 1.2em;
                    overflow-y: scroll;
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr;
                    column-gap: 1.2em;
               }

               main > .card {
                    background-color: var(--background-color);
                    border: 1px solid var(--border-color);
                    margin-bottom: 1.2em;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               }

               main > .card > .card-header {
                    background-color: var(--primary-color);
                    color: var(--background-color);
                    padding: 1em;
                    border-bottom: 1px solid var(--border-color);
               }

               main > .card > .card-body {
                    padding: 0 1em;
               }

               main > .card > .card-body > *:not(br) {
                    margin: 1em 0;
               }


               a:not(li > a) {
                    text-decoration: underline;
                    color: var(--primary-color);
               }
               
               a:not(li > a):hover {
                    color: var(--primary-dark);
               }

               ul, ol {
                    list-style-position: inside;
               }

               ul > li::marker {
                    color: var(--primary-color);
               }

               input[type=text], input[type=password], input[type=number] {
                    border: 0;
                    padding: 0.2em;
                    border-bottom: 2px solid var(--border-color);
                    background-color: var(--background-color);
               }

               input[type=text]:focus, input[type=password]:focus, input[type=number]:focus {
                    outline: none;
                    border-bottom-color: var(--primary-color);
                    background-color: var(--border-color);
               }

               input[type=button], input[type=submit], button {
                    background-color: var(--background-color);
                    padding: 0.4em;
                    outline: none;
                    border: 2px solid var(--border-color);
                    cursor: pointer;
               }

               input[type=button]:hover, input[type=submit]:hover, button:hover {
                    background-color: var(--primary-color);
                    color: var(--background-color);
                    border: 2px solid var(--primary-color);
               }


               @media screen and (max-width: 992px) {
                    body {
                         font-size: 14px;
                    }
                    
                    main {
                         grid-template-columns: auto;
                    }
               }

               ";
        // line 171
        yield from $this->unwrap()->yieldBlock('css', $context, $blocks);
        // line 172
        yield "          </style>
          <link
               rel=\"stylesheet\"
               href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css\"
          />
     </head>
     <body>
          <div class=\"container\">
               ";
        // line 180
        if (($context["nav"] ?? null)) {
            // line 181
            yield "                    <nav>
                         <ul>
                              <li ";
            // line 183
            if ((($context["activeNavItem"] ?? null) == "Dashboard")) {
                yield "class=\"active\"";
            }
            yield ">
                                   <i class=\"fas fa-tachometer-alt\"></i>
                                   <span>Dashboard</span>
                              </li>
                              <li ";
            // line 187
            if ((($context["activeNavItem"] ?? null) == "Pages")) {
                yield "class=\"active\"";
            }
            yield ">
                                   <i class=\"fas fa-file-alt\"></i>
                                   <span>Pages</span>
                              </li>
                              <li ";
            // line 191
            if ((($context["activeNavItem"] ?? null) == "Settings")) {
                yield "class=\"active\"";
            }
            yield ">
                                   <i class=\"fas fa-cog\"></i>
                                   <span>Settings</span>
                              </li>
                              <li ";
            // line 195
            if ((($context["activeNavItem"] ?? null) == "Settings")) {
                yield "class=\"active\"";
            }
            yield ">
                                   <i class=\"fas fa-cog\"></i>
                                   <span>Settings</span>
                              </li>
                         </ul>
                    </nav>
               ";
        }
        // line 202
        yield "               <main>
               ";
        // line 203
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 204
        yield "               </main>
          </div>
     </body>
</html>
";
        return; yield '';
    }

    // line 9
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    // line 171
    public function block_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    // line 203
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "base.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  308 => 203,  301 => 171,  294 => 9,  285 => 204,  283 => 203,  280 => 202,  268 => 195,  259 => 191,  250 => 187,  241 => 183,  237 => 181,  235 => 180,  225 => 172,  223 => 171,  134 => 84,  130 => 82,  126 => 80,  124 => 79,  51 => 9,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "base.twig", "/srv/http/clockwork-cms/clockwork-admin/templates/base.twig");
    }
}
