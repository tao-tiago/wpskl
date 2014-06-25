<?php

/*
Plugin Name: Tao Form Ajax
Plugin URI: http://www.bindigital.com.br
Description: Tao Form Ajax BinDigital
Version: 1.0
Author: Tiago Pires
Author URI: http://www.bindigital.com.br
*/


/* CHAMADAS */
/* Styles */
add_action( 'wp_enqueue_scripts', 'calltao' );
function calltao(){
/* Scripts */
	wp_enqueue_script( "validate", plugin_dir_url( __FILE__ ) . "html/js/validate.js", array('jquery') );
	wp_enqueue_script( "ajax-request", plugin_dir_url( __FILE__ ) . "html/js/ajax.js" );  
	wp_localize_script( 'ajax-request', 'TaoAjax', array( 'ajaxSave' => admin_url( 'admin-ajax.php?action=save_form' )) );

}

class Tao_Form
{
    public function install()
    {
    	global $wpdb;
		$table = $wpdb->prefix."tao_form";
        $wpdb->query("CREATE TABLE IF NOT EXISTS $table ( id int NOT NULL Auto_Increment, nome varchar(100), email varchar(50), Data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id) ) CHARACTER SET utf8 COLLATE utf8_general_ci;");
    }

    public function uninstall()
    {
		global $wpdb;
        $table = $wpdb->prefix."tao_form";
		$wpdb->query("DROP TABLE IF EXISTS $table");
    }

    public function save_form()
    {
        global $wpdb;
        $table = $wpdb->prefix.'tao_form';
	    $dados = array();
	    $dados['nome'] = $_POST['nome'];
	    $dados['email'] = $_POST['email'];
	    $wpdb->insert($table, $dados, '%s');
        die($wpdb->last_error);
    }
	
	public function reg_num()
	{
		global $wpdb;
        $table = $wpdb->prefix.'tao_form';
        $selected = $wpdb->prepare("SELECT * FROM $table", "");
        $resultreg = mysql_query($selected) or die(mysql_error());
        $total = mysql_num_rows($resultreg);
		return $total;
	}
	
	public function exportMysqlToCsv()
	{
		global $wpdb;
		$table = $wpdb->prefix.'tao_form';
	    $csv_terminated = "\n";
	    $csv_separator = ";";
	    $csv_enclosed = '"';
	    $csv_escaped = "\\";
	    $sql_query = $wpdb->prepare("SELECT * FROM $table", "");
	    $result = mysql_query($sql_query) or die (mysql_error());
	    $fields_cnt = mysql_num_fields($result);
	    $schema_insert = '';
	    for ($i = 0; $i < $fields_cnt; $i++)
	    {
	        $l = $csv_enclosed . str_replace($csv_enclosed, $csv_escaped . $csv_enclosed,
	            stripslashes(mysql_field_name($result, $i))) . $csv_enclosed;
	        $schema_insert .= $l;
	        $schema_insert .= $csv_separator;
	    }
	    $out = trim(substr($schema_insert, 0, -1));
	    $out .= $csv_terminated;
	    
	    while ($row = mysql_fetch_array($result))
	    {
	        $schema_insert = '';
	        for ($j = 0; $j < $fields_cnt; $j++)
	        {
	            if ($row[$j] == '0' || $row[$j] != '')
	            {
	                if ($csv_enclosed == '')
	                {
	                    $schema_insert .= $row[$j];
	                } else
	                {
	                    $schema_insert .= $csv_enclosed .
	                    str_replace($csv_enclosed, $csv_escaped . $csv_enclosed, $row[$j]) . $csv_enclosed;
	                }
	            } else
	            {
	                $schema_insert .= '';
	            }
	            if ($j < $fields_cnt - 1)
	            {
	                $schema_insert .= $csv_separator;
	            }
	        } // end for
	        $out .= $schema_insert;
	        $out .= $csv_terminated;
	    } // end while
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Content-Length: " . strlen($out));
	    header("Content-type: text/csv");
	    header("Content-Disposition: attachment; filename='registros.csv'");
	    echo $out;
	    exit;
	}

}

# -----------------------------------------------------------------------------#
// Call Metode create Data Base
register_activation_hook(dirname(__FILE__) . DIRECTORY_SEPARATOR . basename(__FILE__), array('Tao_Form', 'install'));
// Call Metode drop Data Base
register_deactivation_hook(dirname(__FILE__) . DIRECTORY_SEPARATOR . basename(__FILE__), array('Tao_Form', 'uninstall'));

# -----------------------------------------------------------------------------#
// Function Save Form
add_action('wp_ajax_save_form', array('Tao_Form', 'save_form'));
add_action('wp_ajax_nopriv_save_form', array('Tao_Form', 'save_form'));

// Function Export Register Cadastre
add_action('wp_ajax_exportMysqlToCsv', array('Tao_Form', 'exportMysqlToCsv'));

# -----------------------------------------------------------------------------#
// Form Cadastre Front-end
class Tao_Form_WG extends WP_Widget {

	public function __construct() {
		//Identificador do widget
    	$id_base = 'tao_form';
    	//Nome do Widget que será exibido
    	$name = 'Formulário Mailling';
    	//Adicionado Descrição do widget
    	$widget_options = array('description' => 'Formulário Captura de Emails');
		
		parent::__construct($id_base, $name, $widget_options);
	}
	
	#public function form($instance) {}
	
	#public function update($new_instance, $old_instance) {}
	
	public function widget($args, $instance) {
		require_once (dirname(__FILE__).'/html/form-cadastro.php');
	}
	
}


//Função para registar o widget
function tao_form(){
    //Registra o widget que criamos
     register_widget( 'Tao_Form_WG' );
}

//Com função add_action, atribuimos uma função, usando o gancho widgets_init
add_action( 'widgets_init', 'tao_form' );

// Insitar em uma pagina o seguinte codigo [form_mailing] para que seja exibido o formulario
add_shortcode('form_mailing', array( 'Tao_Form_WG', 'widget' ));


// Form Back-end
require_once (dirname(__FILE__).'/html/form-export.php');
