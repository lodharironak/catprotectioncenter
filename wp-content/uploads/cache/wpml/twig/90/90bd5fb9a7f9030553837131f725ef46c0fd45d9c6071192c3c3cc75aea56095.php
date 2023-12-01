<?php

namespace WPML\Core;

use \WPML\Core\Twig\Environment;
use \WPML\Core\Twig\Error\LoaderError;
use \WPML\Core\Twig\Error\RuntimeError;
use \WPML\Core\Twig\Markup;
use \WPML\Core\Twig\Sandbox\SecurityError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedTagError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFilterError;
use \WPML\Core\Twig\Sandbox\SecurityNotAllowedFunctionError;
use \WPML\Core\Twig\Source;
use \WPML\Core\Twig\Template;

/* /setup/attributes.twig */
class __TwigTemplate_d04bbd272e40982b9d5f4ea9ec0d05df0c973249830c54582be41ce0cb138fe9 extends \WPML\Core\Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<span id=\"";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "step_id", []), "html", null, true);
        echo "\">
<h1>";
        // line 2
        echo $this->getAttribute(($context["strings"] ?? null), "heading", []);
        echo "</h1>

<p>";
        // line 4
        echo $this->getAttribute(($context["strings"] ?? null), "description_1", []);
        echo "</p>
<p>";
        // line 5
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "description_2", []), "html", null, true);
        echo "</p>

";
        // line 7
        if (($context["attributes"] ?? null)) {
            // line 8
            echo "    <ul class=\"no-bullets\" >
    ";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["attributes"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["attribute"]) {
                // line 10
                echo "    <li>
        <label>
            <input type=\"hidden\" name=\"attributes[";
                // line 12
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["attribute"], "name", []), "html", null, true);
                echo "]\" value=\"0\" />
            <input type=\"checkbox\" name=\"attributes[";
                // line 13
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["attribute"], "name", []), "html", null, true);
                echo "]\" value=\"1\" ";
                if ($this->getAttribute($context["attribute"], "translated", [])) {
                    echo "checked=\"checked\"";
                }
                echo " />
            ";
                // line 14
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["attribute"], "label", []), "html", null, true);
                echo "
        </label>
    </li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attribute'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "    </ul>
";
        } else {
            // line 20
            echo "    <p><i>";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "no_attributes", []), "html", null, true);
            echo "</i></p>
";
        }
        // line 22
        echo "
<p class=\"wcml-setup-actions step\">
    <a href=\"";
        // line 24
        echo \WPML\Core\twig_escape_filter($this->env, ($context["go_back_url"] ?? null), "html", null, true);
        echo "\" class=\"go-back\">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "go_back", []), "html", null, true);
        echo "</a>
    <a href=\"";
        // line 25
        echo \WPML\Core\twig_escape_filter($this->env, ($context["continue_url"] ?? null), "html", null, true);
        echo "\" class=\"button button-large button-primary submit\">";
        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "continue", []), "html", null, true);
        echo "</a>
</p>
</span>
";
    }

    public function getTemplateName()
    {
        return "/setup/attributes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 25,  100 => 24,  96 => 22,  90 => 20,  86 => 18,  76 => 14,  68 => 13,  64 => 12,  60 => 10,  56 => 9,  53 => 8,  51 => 7,  46 => 5,  42 => 4,  37 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "/setup/attributes.twig", "/opt/lampp/htdocs/catprotectioncenter/wp-content/plugins/woocommerce-multilingual/templates/setup/attributes.twig");
    }
}
