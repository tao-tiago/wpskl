<?php
add_action('admin_menu','options_admin');

function options_admin () { 
    add_menu_page(
    'Exportar Contatos',             
    'Exportar Contatos',
    'manage_options',
    'opcoes_tema',
    'opcoes'
    );
}

function opcoes() { ?>
	
    <div class="wrap">
        <h2>Exportar Formul&aacute;rio de Cadastro</h2>
        
        <form action="<?php echo admin_url('admin-ajax.php?action=exportMysqlToCsv'); ?>" method="post">
        <table class="form-table" width="600">
            <tr>
            	<?php $regall = new Tao_Form(); ?>
                <td>Voc&ecirc; possue <strong><?php echo $regall->reg_num(); ?></strong> registro(s)</td>
            </tr>
            <tr><td><strong>Pr&eacute;via dos registros</strong></td></tr>
            <tr><td>
                <table width="600">
	                <tr>
	                    <td><strong>Nome</strong></td>
	                    <td><strong>Email</strong></td>
	                </tr>
	                <tr>
	                    <?php
	                    global $wpdb;
	        			$table = $wpdb->prefix.'tao_form';
	                    $selectedprev = $wpdb->prepare("SELECT nome, email FROM $table limit 10", "");
					    $resultregprev = mysql_query($selectedprev) or die(mysql_error());
					    while ($row = mysql_fetch_array($resultregprev))
					    {
					        echo '<td>'.$row[0].'</td>'.'<td>'.$row[1].'</td></tr><tr>';
					    }
	                    ?>                    
	                </tr>
                </table>
            </td></tr>
            <tr>
                <td>
                    <p class="submit">
                        <input type="submit" value="Exportar Dados" />
                    </p>
                </td>
            </tr>
        </table>
        </form>
    </div>
<?php } ?>