<?php
class PluginDbSchema{
  function __construct(){
    wfPlugin::includeonce('wf/yml');    
  }
  private function buto_data(){
    return new PluginWfYml(wfGlobals::getAppDir().'/../buto_data/theme/[theme]/plugin_db_schema.yml');
  }
  private function buto_data_field_key($schema, $table, $field){
    return str_replace("/", "_", $schema)."/table/$table/field/$field";
  }
  private function buto_data_table_key($schema, $table){
    return str_replace("/", "_", $schema)."/table/$table";
  }
  public function widget_list_field($data){
    $buto_data = $this->buto_data();
    /**
     * 
     */
    $data = new PluginWfArray($data);
    /**
     * 
     */
    $field = array();
    foreach($data->get('data/schema') as $v){
      $i = new PluginWfYml($v);
      $extra = new PluginWfArray($i->get('extra'));
      foreach($i->get('tables') as $k2 => $v2){
        $i2 = new PluginWfArray($v2);
        foreach($i2->get('field') as $k3 => $v3){
          $i3 = new PluginWfArray($v3);
          $temp = new PluginWfArray();
          $temp->set('schema', $v);
          $temp->set('table_name', $k2);
          $temp->set('field_name', $k3);
          $temp->set('type', $i3->get('type'));
          $temp->set('not_null', $i3->get('not_null'));
          $temp->set('primary_key', $i3->get('primary_key'));
          $temp->set('auto_increment', $i3->get('auto_increment'));
          $temp->set('default', $i3->get('default'));
          $temp->set('description', $i3->get('description'));
          $temp->set('foreing_key_reference_table', $i3->get('foreing_key/reference_table'));
          $temp->set('foreing_key_reference_field', $i3->get('foreing_key/reference_field'));
          $temp->set('foreing_key_on_delete', $i3->get('foreing_key/on_delete'));
          $temp->set('foreing_key_on_update', $i3->get('foreing_key/on_update'));
          /**
           * Own description
           */
          $buto_data_key = $this->buto_data_field_key($v, $k2, $k3);
          $temp->set('own_description', $buto_data->get($buto_data_key.'/own_description'));
          /**
           * Row attribute
           */
          $row_attribute = new PluginWfArray();
          $row_attribute->set('schema', $v);
          $row_attribute->set('table_name', $k2);
          $row_attribute->set('field_name', $k3);
          $temp->set('row_attribute', $row_attribute->get());
          /**
           * Row click
           */
          $url = '/db_schema/field_form?schema='.$v.'&table_name='.$k2.'&field_name='.$k3;
          $temp->set('row_click', "db_schema_field_row = this; PluginWfBootstrapjs.modal({id: 'modal_field_form', url: '$url', label: 'Field'});");
          /**
           */
          $field[] = $temp->get();
        }
        /**
         * extra
         */
        if($extra->get('field')){
          foreach($extra->get('field') as $k3 => $v3){
            $i3 = new PluginWfArray($v3);
            $temp = new PluginWfArray();
            $temp->set('schema', $v);
            $temp->set('table_name', $k2);
            $temp->set('field_name', $k3);
            $temp->set('type', $i3->get('type'));
            $temp->set('not_null', $i3->get('not_null'));
            $temp->set('primary_key', $i3->get('primary_key'));
            $temp->set('auto_increment', $i3->get('auto_increment'));
            $temp->set('default', $i3->get('default'));
            $temp->set('description', $i3->get('description'));
            $temp->set('foreing_key_reference_table', $i3->get('foreing_key/reference_table'));
            $temp->set('foreing_key_reference_field', $i3->get('foreing_key/reference_field'));
            $temp->set('foreing_key_on_delete', $i3->get('foreing_key/on_delete'));
            $temp->set('foreing_key_on_update', $i3->get('foreing_key/on_update'));
            /**
            * Own description
            */
            $buto_data_key = $this->buto_data_field_key($v, $k2, $k3);
            $temp->set('own_description', $buto_data->get($buto_data_key.'/own_description'));
            /**
            * Row attribute
            */
            $row_attribute = new PluginWfArray();
            $row_attribute->set('schema', $v);
            $row_attribute->set('table_name', $k2);
            $row_attribute->set('field_name', $k3);
            $temp->set('row_attribute', $row_attribute->get());
            /**
            * Row click
            */
            $url = '/db_schema/field_form?schema='.$v.'&table_name='.$k2.'&field_name='.$k3;
            $temp->set('row_click', "db_schema_field_row = this; PluginWfBootstrapjs.modal({id: 'modal_field_form', url: '$url', label: 'Field'});");
            /**
             */
            $field[] = $temp->get();
          }
        }
      }
    }
    /**
     */
    if($data->get('data/method')){
      wfPlugin::includeonce($data->get('data/method/plugin'));
      $obj = wfSettings::getPluginObj($data->get('data/method/plugin'));
      $method = $data->get('data/method/method');
      $field = $obj->$method($field);
    }
    /**
     * 
     */
    wfPlugin::enable('wf/table');
    $element = new PluginWfYml(__DIR__.'/element/widget_list_field.yml');
    $element->setByTag(array('data' => $field));
    wfDocument::renderElement($element->get());
  }
  public function widget_list_table($data){
    $buto_data = $this->buto_data();
    /**
     * 
     */
    $data = new PluginWfArray($data);
    /**
     * 
     */
    $table = array();
    foreach($data->get('data/schema') as $v){
      $i = new PluginWfYml($v);
      foreach($i->get('tables') as $k2 => $v2){
        $i2 = new PluginWfArray($v2);
        $temp = new PluginWfArray();
        $temp->set('schema', $v);
        $temp->set('table_name', $k2);
        $temp->set('description', $i2->get('description'));
        /**
          * Own description
          */
        $buto_data_key = $this->buto_data_table_key($v, $k2);
        $temp->set('own_description', $buto_data->get($buto_data_key.'/own_description'));
        /**
          * Row attribute
          */
        $row_attribute = new PluginWfArray();
        $row_attribute->set('schema', $v);
        $row_attribute->set('table_name', $k2);
        $temp->set('row_attribute', $row_attribute->get());
        /**
          * Row click
          */
        $url = '/db_schema/table_form?schema='.$v.'&table_name='.$k2;
        $temp->set('row_click', "db_schema_table_row = this; PluginWfBootstrapjs.modal({id: 'modal_table_form', url: '$url', label: 'Table'});");
        $table[] = $temp->get();
      }
    }
    /**
     * 
     */
    wfPlugin::enable('wf/table');
    $element = new PluginWfYml(__DIR__.'/element/widget_list_table.yml');
    $element->setByTag(array('data' => $table));
    wfDocument::renderElement($element->get());
  }
  public function page_field_form(){
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    $element->setByTag(array('method' => 'render'));
    wfDocument::renderElement($element);
  }
  public function page_field_capture(){
    $element = new PluginWfYml(__DIR__.'/element/page_field_form.yml');
    $element->setByTag(array('method' => 'capture'));
    wfDocument::renderElement($element);
  }
  public function form_field_render($form){
    $form = new PluginWfArray($form);
    $buto_data = $this->buto_data();
    $buto_data_key = $this->buto_data_field_key(wfRequest::get('schema'), wfRequest::get('table_name'), wfRequest::get('field_name'));
    $data = new PluginWfArray(wfRequest::getAll());
    $data->set('own_description', $buto_data->get($buto_data_key.'/own_description'));
    $form->setByTag($data->get());
    return $form->get();
  }
  public function form_field_capture(){
    $buto_data = $this->buto_data();
    $buto_data_key = $this->buto_data_field_key(wfRequest::get('schema'), wfRequest::get('table_name'), wfRequest::get('field_name'));
    $buto_data->set($buto_data_key.'/own_description', wfRequest::get('own_description'));
    $buto_data->save();
    return array("db_schema_field_row.childNodes[27].innerHTML='".wfRequest::get('own_description')."'; $('#modal_field_form').modal('hide')");
  }
  public function page_table_form(){
    $element = new PluginWfYml(__DIR__.'/element/'.__FUNCTION__.'.yml');
    $element->setByTag(array('method' => 'render'));
    wfDocument::renderElement($element);
  }
  public function page_table_capture(){
    $element = new PluginWfYml(__DIR__.'/element/page_table_form.yml');
    $element->setByTag(array('method' => 'capture'));
    wfDocument::renderElement($element);
  }
  public function form_table_render($form){
    $form = new PluginWfArray($form);
    $buto_data = $this->buto_data();
    $buto_data_key = $this->buto_data_table_key(wfRequest::get('schema'), wfRequest::get('table_name'));
    $data = new PluginWfArray(wfRequest::getAll());
    $data->set('own_description', $buto_data->get($buto_data_key.'/own_description'));
    $form->setByTag($data->get());
    return $form->get();
  }
  public function form_table_capture(){
    $buto_data = $this->buto_data();
    $buto_data_key = $this->buto_data_table_key(wfRequest::get('schema'), wfRequest::get('table_name'));
    $buto_data->set($buto_data_key.'/own_description', wfRequest::get('own_description'));
    $buto_data->save();
    return array("db_schema_table_row.childNodes[7].innerHTML='".wfRequest::get('own_description')."'",  "$('#modal_table_form').modal('hide')");
  }
}
