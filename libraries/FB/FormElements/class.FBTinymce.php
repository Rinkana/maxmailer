<?php
/**
 * User: Rinkana
 * Date: 2-12-13
 * Time: 17:40
 * @Author: Max Berends
 */
class FBTinymce extends FormBuilderElement {
    protected $aAttributes = array(
        "toolbar" => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        "removeditems" => "newdocument"
    );

    public function render(){
        $sHTML = "<textarea ".$this->getAttributes(array("Value","toolbar","RemovedItems")).">";
        $sHTML .= $this->getAttribute("Value");
        $sHTML .= "</textarea>";
        $sHTML .= '<script type="text/javascript">
                       tinymce.init({
                           selector: "#'.$this->getAttribute("id").'",
                           plugins: [
                           "advlist autolink lists link image charmap print preview anchor",
                           "searchreplace visualblocks code fullscreen",
                           "insertdatetime media table contextmenu paste image"
                       ],
                           toolbar: "'.$this->getAttribute("toolbar").'",
                           relative_urls: false,
                           '.($this->getAttribute("height") > 0 ? 'height:'.$this->getAttribute("height").',' : '').'
                           '.($this->getAttribute("width") > 0 ? 'width:'.$this->getAttribute("width").',' : '').'
                           removed_menuitems: "'.$this->getAttribute("RemovedItems").'"

                       });
                   </script>';
        return $sHTML;
    }
}
?>