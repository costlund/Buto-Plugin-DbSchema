<?php
class PluginDbSchema{
  public function widget_list_field($data){
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
          $field[] = $temp->get();
        }
        /**
         * extra
         */
        if($extra->get('field')){
          foreach($extra->get('field') as $k3 => $v3){
            $i3 = new PluginWfArray($v3);
            $temp = new PluginWfArray();
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
            $field[] = $temp->get();
          }
        }
      }
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
        $temp->set('table_name', $k2);
        $temp->set('description', $i2->get('description'));
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
}
