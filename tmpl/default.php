<?php
/**
 * @author
 * @copyright
 * @license
 */
$document = JFactory::getDocument();
JHTML::_('behavior.modal');
$app = JFactory::getApplication('site');

$componentParams = $app->getParams('com_programas');
// Acessa a categoria da extensão programas


$db = JFactory::getDbo();
$query = $db->getQuery(true);
//seleciona as colunas da tabela
$query->select($db->quoteName(array('id', 'title', 'extension')));
//seleciona a tabela
$query->from($db->quoteName('#__categories')) ;
$query->where($db->quoteName('extension')." = ".$db->quote('com_programas'));

//organiza os resultados obtidos em ordem ascendente usando como parâmetro a coluna data_atracao
$query->order('title ASC');
$db->setQuery($query);
$results = $db->loadObjectList();


$icon_font_family = $componentParams->get('icon_font_family', defaultValue);
$load_font_awesome = $componentParams->get('load_font_awesome', defaultValue);
$iconfont = 'fa fa';
if ($icon_font_family == '0'){
 $iconfont = '';
}
if ($icon_font_family == '1'){
 $iconfont = 'icon icon';
}
if ($icon_font_family == '2'){
 $iconfont = 'fa fa';
}
if (($load_font_awesome == '0') and ($params->get('turn_on_font_awesome') == '1')){
   $document->addStyleSheet(JURI::base().'components/com_programas/assets/css/font-awesome.min.css');
}
if (($load_font_awesome == '1') and ($params->get('turn_on_font_awesome') == '1')){
   $document->addStyleSheet(JURI::base().'components/com_programas/assets/css/font-awesome.min.css');
}
defined("_JEXEC") or die("Restricted access");
$config = JFactory::getConfig();
$offset = $config->get('offset');
//$h = $offset;// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
//$hm = $h * (60);
//$ms = $hm * 60;
$gmdate = gmdate("H:i", time()); // the "-" can be switched to a plus if that's what your time zone is.
$gmday = gmdate("l", time());
$module_category = $params->get('mycategory');
foreach($results as $result){

 if ($result->id == $module_category){
  $category_title = $result->title;
  $category_id = $result->id;
 }
}
 $enabled = $params->get('enable_disable');


?>
<div class="row-fluid">
    <?php $haveprogram = '0';?>

<?php
echo $offset;
foreach ($items as $i => $item) : ?>
    <?php
    $theinitialtime = JHtml::date($item->start_time, 'H:i');
    $thefinaltime = JHtml::date($item->end_time, 'H:i');
    $thedays = json_decode($item->days_of_the_week);
     ?>
<?php  foreach ($thedays as $theday) : ?>

<?php if (($gmday == $theday) and ($gmdate >= $theinitialtime) and ($gmdate <= $thefinaltime) and ($item->state == '1')) : ?>
    <?php if ($item->category == $module_category) : ?>

        <?php $haveprogram = '1';?>
        <?php $popup_title = $category_title;?>

         <?php if (in_array('program_name', $enabled) or $params->get('enable_defaults')) : ?>
        <h4 class="program_name"><?php echo $item->program_name;?></h4>
         <?php endif;?>
        <?php if (in_array('category_title', $enabled) or $params->get('enable_defaults')) : ?>
        <h5> <?php echo $category_title?> </h5>
        <?php endif;?>
        <?php if ((in_array('start_time', $enabled) and in_array('end_time', $enabled)) or $params->get('enable_defaults')) : ?>
        <p class="program_time"><?php echo JHtml::date($item->start_time, 'H:i').' h';?> - <?php echo JHtml::date($item->end_time, 'H:i').' h';?></p>
        <?php endif;?>
        <?php if (in_array('program_link', $enabled) or $params->get('enable_defaults')) : ?>
        <p class="program_link"><a href="<?php echo $item->program_link;?>" target="_blank"><?php echo $item->program_link;?></a></p>
        <?php endif;?>
        <?php if ($params->get('custom_message')) : ?>
        <div class="span12 col-md-12 custom_message"><?php echo $params->get('custom_message');?></div>
        <?php endif;?>
        <?php if (in_array('program_description', $enabled)) : ?>
        <div class="span12 col-md-12 program_description"><?php echo $item->program_description;?></div>
        <?php endif;?>
        <?php if (in_array('broadcaster_image', $enabled) or $params->get('enable_defaults')) : ?>
        <p class="broadcaster_image"><a href="<?php echo $item->broadcaster_image;?>" class="modal"><img src="<?php echo $item->broadcaster_image;?>" alt="<?php echo $item->broadcaster_name;?>" /></a></p>
        <?php endif;?>
        <?php if (in_array('broadcaster_name', $enabled) or $params->get('enable_defaults')) : ?>
        <h5 class="broadcaster_name"><?php echo $item->broadcaster_name;?></h5>
        <?php endif;?>
        <div class="broadcaster_social col-md-12">
         <?php if (in_array('broadcaster_whatsapp', $enabled) or $params->get('enable_defaults')) : ?>
        <p><i class="fa fa-whatsapp"></i> <?php echo $item->broadcaster_whatsapp;?> </p>
        <?php endif;?>
        <?php if (in_array('broadcaster_facebook', $enabled)) : ?>
        <a href="<?php echo $item->broadcaster_facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a>
        <?php endif;?>
        <?php if (in_array('broadcaster_twitter', $enabled)) : ?>
        <a href="<?php echo $item->broadcaster_twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a>
        <?php endif;?>
        <?php if (in_array('broadcaster_instagram', $enabled)) : ?>
        <a href="<?php echo $item->broadcaster_instagram;?>" target="_blank"><i class="fa fa-instagram"></i></a>
        <?php endif;?>
        <?php if (in_array('broadcaster_snapchat', $enabled)) : ?>
        <a href="<?php echo $item->broadcaster_snapchat;?>" target="_blank"><i class="fa fa-snapchat"></i></a>
        <?php endif;?>
       <?php if (in_array('broadcaster_telegram', $enabled)) : ?>
        <a href="<?php echo $item->broadcaster_telegram;?>" target="_blank"><i class="fa fa-paper-plane"></i></a>
        <?php endif;?>

         <?php if (in_array('broadcaster_email', $enabled)) : ?>
        <a href="mailto:<?php echo $item->broadcaster_email;?>" target="_blank"><i class="fa fa-envelope"></i></a>
        <?php endif;?>
         <?php if (in_array('broadcaster_link', $enabled)) : ?>
        <a href="<?php echo $item->broadcaster_link;?>" target="_blank"><i class="fa fa-globe"></i></a>
        <?php endif;?>
        <?php if (in_array('broadcaster_bio', $enabled)) : ?>
        <div class="span12 col-md-12 broadcaster_bio"><?php echo $item->broadcaster_bio;?></div>
        <?php endif;?>
        </div>
        <?php if (($params->get('button_code')) and ($params->get('module_or_custom_script') == '0')) : ?>
        <div class="span12 col-md-12">
            <?php echo "<a onclick=\"printDiv('SimuladorFormulario');\" id=\"btnPrint\" href=\"javascript:void(0);\" class=\"buttoncode\">".$params->get('button_code')."</a>"; ?>
        </div>
        <?php endif; ?>
         <?php if ($params->get('module_or_custom_script') == '1') : ?>
        <div class="span12 col-md-12">
            <?php echo $params->get('custom_script'); ?>
        </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>

    <?php if ($haveprogram == '0') : ?>
        <h4 class="program_name"><?php echo JText::_('MOD_PROGRAMAS_OFFLINE');?></h4>
        <?php if (in_array('category_title', $enabled)) : ?>
        <h5> <?php echo $category_title?> </h5>
        <?php endif;?>
    <?php endif; ?>

 </div>
 <?php if (($params->get('button_code')) and ($params->get('module_or_custom_script') == '0')) : ?>
<script type="text/javascript">
 jQuery(document).ready(function () {
  //Print div
jQuery("#btnPrint").live("click", function () {
            var printWindow = window.open('', "printWindow", "width=<?php echo $params->get('popup_width');?>,height=<?php echo $params->get('popup_height');?>,50%,50%,directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no");
            printWindow.document.write('<html><head><title>' + '<?php echo $popup_title;?>' + '</title>');
            printWindow.document.write('<style type="text/css">thead tr{background:#f1fcb1 none repeat scroll 0 0 !important;  box-sizing:border-box;  font-weight:bold;  line-height:2em;  text-transform:uppercase;} tr:nth-child(2n+1){background:#d5d5a8 none repeat scroll 0 0;} tr:nth-child(2n+2){background:#f6f6c9 none repeat scroll 0 0;}.totalizacao { background: #f1fcb1 none repeat scroll 0 0 !important; box-sizing: border-box; display: inline-block; font-weight: bold; line-height: 2em; text-transform: uppercase; padding: 10px; }</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write('<?php echo $params->get('builtin_script');?>');
            printWindow.document.close();

        });

});
 </script>
 <?php endif; ?>
