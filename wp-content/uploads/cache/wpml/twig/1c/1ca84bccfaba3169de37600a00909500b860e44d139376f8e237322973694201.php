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

/* custom-prices.twig */
class __TwigTemplate_f686f3ff3efa2f28d44cf1434cb63d5950f9ea2fe9885cf6bf05c6b3a01a35ed extends \WPML\Core\Twig\Template
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
        if (($context["is_variation"] ?? null)) {
            // line 2
            echo "    <tr><td>
";
        }
        // line 4
        echo "
<div class=\"wcml_custom_prices_block\">
    ";
        // line 6
        if (twig_test_empty(($context["currencies"] ?? null))) {
            // line 7
            echo "        <div class=\"wcml_custom_prices_options_block\">
            <label>";
            // line 8
            echo $this->getAttribute(($context["strings"] ?? null), "not_set", []);
            echo "</label>
        </div>
    ";
        } else {
            // line 11
            echo "        <div class=\"wcml_custom_prices_options_block\">

            <label for=\"wcml_custom_prices_auto[";
            // line 13
            echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
            echo "]\">
                <input type=\"radio\" name=\"_wcml_custom_prices[";
            // line 14
            echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
            echo "]\" id=\"wcml_custom_prices_auto[";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
            echo "]\" value=\"0\" class=\"wcml_custom_prices_input\" ";
            echo ($context["checked_calc_auto"] ?? null);
            echo " />
                ";
            // line 15
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "calc_auto", []), "html", null, true);
            echo "&nbsp;
                <span class=\"block_actions\" ";
            // line 16
            if ( !twig_test_empty(($context["checked_calc_auto"] ?? null))) {
                echo " style=\"display: inline;\" ";
            }
            echo ">(
                    <a href=\"\" class=\"wcml_custom_prices_auto_block_show\" title=\"";
            // line 17
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "see_prices", []));
            echo "\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "show", []), "html", null, true);
            echo "</a>
                    <a href=\"\" class=\"wcml_custom_prices_auto_block_hide\">";
            // line 18
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "hide", []), "html", null, true);
            echo "</a>
                )</span>
            </label>


            <label for=\"wcml_custom_prices_manually[";
            // line 23
            echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
            echo "]\">
                <input type=\"radio\" name=\"_wcml_custom_prices[";
            // line 24
            echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
            echo "]\" value=\"1\" id=\"wcml_custom_prices_manually[";
            echo \WPML\Core\twig_escape_filter($this->env, ($context["product_id"] ?? null), "html", null, true);
            echo "]\" class=\"wcml_custom_prices_input\" ";
            echo ($context["checked_calc_manually"] ?? null);
            echo " />
                ";
            // line 25
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "set_manually", []), "html", null, true);
            echo "
            </label>
            <div class=\"wcml_custom_prices_manually_block_control\">
                <a ";
            // line 28
            if ( !twig_test_empty(($context["checked_calc_manually"] ?? null))) {
                echo " style=\"display:none\" ";
            }
            echo " href=\"\" class=\"wcml_custom_prices_manually_block_show\">&raquo; ";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "enter_prices", []), "html", null, true);
            echo "</a>
                <a style=\"display:none\" href=\"\" class=\"wcml_custom_prices_manually_block_hide\">- ";
            // line 29
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "hide_prices", []), "html", null, true);
            echo "</a>
            </div>
        </div>

        <div class=\"wcml_custom_prices_manually_block\" ";
            // line 33
            if ( !twig_test_empty(($context["checked_calc_manually"] ?? null))) {
                echo " style=\"display: block;\" ";
            }
            echo ">
            ";
            // line 34
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                // line 35
                echo "                <div class=\"currency_blck\">
                    <label>
                        ";
                // line 37
                echo $this->getAttribute($context["currency"], "currency_format", []);
                echo "
                    </label>

                    ";
                // line 40
                if (twig_test_empty($this->getAttribute($this->getAttribute($context["currency"], "custom_price", []), "_regular_price", [], "array"))) {
                    // line 41
                    echo "                        <span class=\"wcml_no_price_message\">";
                    echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "det_auto", []), "html", null, true);
                    echo "</span>
                    ";
                }
                // line 43
                echo "
                    ";
                // line 44
                if (($context["is_variation"] ?? null)) {
                    // line 45
                    echo "                        ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["currency"], "custom_price", []));
                    foreach ($context['_seq'] as $context["key"] => $context["custom_price"]) {
                        // line 46
                        echo "                            <p>
                                <label>";
                        // line 47
                        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), $context["key"], [], "array"), "html", null, true);
                        echo " ( ";
                        echo $this->getAttribute($context["currency"], "currency_symbol", []);
                        echo " )</label>
                                <input type=\"text\"
                                       name=\"_custom_variation";
                        // line 49
                        echo \WPML\Core\twig_escape_filter($this->env, $context["key"], "html", null, true);
                        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "custom_id", []), "html", null, true);
                        echo "\"
                                       class=\"wc_input_price wcml_input_price short wcml";
                        // line 50
                        echo \WPML\Core\twig_escape_filter($this->env, $context["key"], "html", null, true);
                        echo "\"
                                       value=\"";
                        // line 51
                        echo \WPML\Core\twig_escape_filter($this->env, $context["custom_price"], "html", null, true);
                        echo "\" step=\"any\" min=\"0\" />
                            </p>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['key'], $context['custom_price'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 54
                    echo "                    ";
                } else {
                    // line 55
                    echo "                        ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["currency"], "custom_html", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["custom_price_html"]) {
                        // line 56
                        echo "                            ";
                        echo $context["custom_price_html"];
                        echo "
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_price_html'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 58
                    echo "                    ";
                }
                // line 59
                echo "
                    <div class=\"wcml_schedule\">
                        <label>";
                // line 61
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "schedule", []), "html", null, true);
                echo "</label>
                        <div class=\"wcml_schedule_options\">


                            <label for=\"wcml_schedule_auto[";
                // line 65
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "currency_code", []), "html", null, true);
                echo "]";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["html_id"] ?? null), "html", null, true);
                echo "\">
                                <input type=\"radio\" name=\"_wcml_schedule[";
                // line 66
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "currency_code", []), "html", null, true);
                echo "]";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["html_id"] ?? null), "html", null, true);
                echo "\"
                                       id=\"wcml_schedule_auto[";
                // line 67
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "currency_code", []), "html", null, true);
                echo "]";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["html_id"] ?? null), "html", null, true);
                echo "\"
                                       value=\"0\"
                                       class=\"wcml_schedule_input\" ";
                // line 69
                echo $this->getAttribute($context["currency"], "schedule_auto_checked", []);
                echo " />
                                ";
                // line 70
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "same_as_def", []), "html", null, true);
                echo "
                            </label>


                            <label for=\"wcml_schedule_manually[";
                // line 74
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "currency_code", []), "html", null, true);
                echo "]";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["html_id"] ?? null), "html", null, true);
                echo "\">
                                <input type=\"radio\" name=\"_wcml_schedule[";
                // line 75
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "currency_code", []), "html", null, true);
                echo "]";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["html_id"] ?? null), "html", null, true);
                echo "\"
                                       value=\"1\"
                                       id=\"wcml_schedule_manually[";
                // line 77
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "currency_code", []), "html", null, true);
                echo "]";
                echo \WPML\Core\twig_escape_filter($this->env, ($context["html_id"] ?? null), "html", null, true);
                echo "\"
                                       class=\"wcml_schedule_input\" ";
                // line 78
                echo $this->getAttribute($context["currency"], "schedule_man_checked", []);
                echo " />
                                ";
                // line 79
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "set_dates", []), "html", null, true);
                echo "
                                <span class=\"block_actions\">(
                                    <a href=\"\" class=\"wcml_schedule_manually_block_show\">";
                // line 81
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "schedule", []), "html", null, true);
                echo "</a>
                                    <a href=\"\" class=\"wcml_schedule_manually_block_hide\">";
                // line 82
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "collapse", []), "html", null, true);
                echo "</a>
                                )</span>
                            </label>

                            <div class=\"wcml_schedule_dates\">
                                <input type=\"text\" class=\"short custom_sale_price_dates_from\"
                                       name=\"_custom";
                // line 88
                if (($context["is_variation"] ?? null)) {
                    echo "_variation";
                }
                echo "_sale_price_dates_from";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "custom_id", []), "html", null, true);
                echo "\"
                                       id=\"_custom_sale_price_dates_from";
                // line 89
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "custom_id", []), "html", null, true);
                echo "\"
                                       value=\"";
                // line 90
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "sale_price_dates_from", []));
                echo "\"
                                       placeholder=\"";
                // line 91
                echo $this->getAttribute(($context["strings"] ?? null), "from", []);
                echo " YYYY-MM-DD\"
                                       maxlength=\"10\" pattern=\"[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])\" />

                                <input type=\"text\" class=\"short custom_sale_price_dates_to\"
                                       name=\"_custom";
                // line 95
                if (($context["is_variation"] ?? null)) {
                    echo "_variation";
                }
                echo "_sale_price_dates_to";
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "custom_id", []), "html", null, true);
                echo "\"
                                       id=\"_custom_sale_price_dates_to";
                // line 96
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "custom_id", []), "html", null, true);
                echo "\"
                                       value=\"";
                // line 97
                echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "sale_price_dates_to", []));
                echo "\"
                                       placeholder=\"";
                // line 98
                echo $this->getAttribute(($context["strings"] ?? null), "to", []);
                echo "  YYYY-MM-DD\"
                                       maxlength=\"10\" pattern=\"[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])\" />

                            </div>
                        </div>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 106
            echo "        </div>

        <div class=\"wcml_automaticaly_prices_block\">

            ";
            // line 110
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["currencies"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                // line 111
                echo "                <label>";
                echo $this->getAttribute($context["currency"], "currency_format", []);
                echo "</label>

                ";
                // line 113
                if (($context["is_variation"] ?? null)) {
                    // line 114
                    echo "                    ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["currency"], "readonly_price", []));
                    foreach ($context['_seq'] as $context["key"] => $context["readonly_price"]) {
                        // line 115
                        echo "                        <p>
                            <label>";
                        // line 116
                        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), $context["key"], [], "array"), "html", null, true);
                        echo " ( ";
                        echo $this->getAttribute($context["currency"], "currency_symbol", []);
                        echo " )</label>
                            <input type=\"text\"
                                   name=\"_readonly";
                        // line 118
                        echo \WPML\Core\twig_escape_filter($this->env, $context["key"], "html", null, true);
                        echo "\"
                                   class=\"wc_input_price short\"
                                   value=\"";
                        // line 120
                        echo \WPML\Core\twig_escape_filter($this->env, $context["readonly_price"]);
                        echo "\"
                                   step=\"any\" min=\"0\" readonly = \"readonly\"
                                   rel=\"";
                        // line 122
                        echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute($context["currency"], "rate", []));
                        echo "\" />
                        </p>
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['key'], $context['readonly_price'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 125
                    echo "                ";
                } else {
                    // line 126
                    echo "                    ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["currency"], "readonly_html", []));
                    foreach ($context['_seq'] as $context["_key"] => $context["readonly_html_price"]) {
                        // line 127
                        echo "                        ";
                        echo $context["readonly_html_price"];
                        echo "
                    ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['readonly_html_price'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 129
                    echo "                ";
                }
                // line 130
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 131
            echo "        </div>
    ";
        }
        // line 133
        echo "
    ";
        // line 134
        if (twig_test_empty(($context["is_variation"] ?? null))) {
            // line 135
            echo "        <div class=\"wcml_price_error\">";
            echo \WPML\Core\twig_escape_filter($this->env, $this->getAttribute(($context["strings"] ?? null), "enter_price", []), "html", null, true);
            echo "</div>
    ";
        }
        // line 137
        echo "</div>

";
        // line 139
        if (($context["is_variation"] ?? null)) {
            // line 140
            echo "    </td></tr>
";
        }
    }

    public function getTemplateName()
    {
        return "custom-prices.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  446 => 140,  444 => 139,  440 => 137,  434 => 135,  432 => 134,  429 => 133,  425 => 131,  419 => 130,  416 => 129,  407 => 127,  402 => 126,  399 => 125,  390 => 122,  385 => 120,  380 => 118,  373 => 116,  370 => 115,  365 => 114,  363 => 113,  357 => 111,  353 => 110,  347 => 106,  333 => 98,  329 => 97,  325 => 96,  317 => 95,  310 => 91,  306 => 90,  302 => 89,  294 => 88,  285 => 82,  281 => 81,  276 => 79,  272 => 78,  266 => 77,  259 => 75,  253 => 74,  246 => 70,  242 => 69,  235 => 67,  229 => 66,  223 => 65,  216 => 61,  212 => 59,  209 => 58,  200 => 56,  195 => 55,  192 => 54,  183 => 51,  179 => 50,  174 => 49,  167 => 47,  164 => 46,  159 => 45,  157 => 44,  154 => 43,  148 => 41,  146 => 40,  140 => 37,  136 => 35,  132 => 34,  126 => 33,  119 => 29,  111 => 28,  105 => 25,  97 => 24,  93 => 23,  85 => 18,  79 => 17,  73 => 16,  69 => 15,  61 => 14,  57 => 13,  53 => 11,  47 => 8,  44 => 7,  42 => 6,  38 => 4,  34 => 2,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "custom-prices.twig", "/opt/lampp/htdocs/catprotectioncenter/wp-content/plugins/woocommerce-multilingual/templates/multi-currency/custom-prices.twig");
    }
}
