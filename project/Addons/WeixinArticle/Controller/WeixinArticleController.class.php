<?php

namespace Addons\WeixinArticle\Controller;
use Think\ManageBaseController;

class WeixinArticleController extends ManageBaseController
{

    // 通用插件的增加模型
    public function add() {
        $model =$this->getModel ( 'weixin_article' );
        $id=I('id');
        if (IS_POST) {
            $Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
            // 获取模型的字段信息
            $Model = $this->checkAttr ( $Model, $model ['id'] );
            //$this->checkTitle($_POST['article_title'],$_POST['cid'],$id);
//            if(is_array($_POST['admin_uid'])){
//                $_POST['admin_uid']=implode($_POST['admin_uid']);
//            }
            if ($Model->create () && $id = $Model->add ()) {
                $this->_saveKeyword ( $model, $id );
                // 清空缓存
                method_exists ( $Model, 'clear' ) && $Model->clear ( $id, 'add' );
                $this->success ( '添加' . $model ['title'] . '成功！', U ( 'lists?model=' . $model ['name'], $this->get_param ) );
            } else {
                $this->error( '400526:'. $Model->getError () );
            }
        } else {
            $fields = get_model_attribute ( $model ['id'] );
            $this->assign ( 'fields', $fields );
            $this->display();
        }
    }

    /* 预览 */
    function preview() {
        $publicid = get_token_appinfo ( '', 'id' );
        $id = intval(I('id'));
        $url = addons_url ( 'WeixinArticle://Wap/detail', array (
            'id' => $id
        ) );
        $this->assign ( 'url', $url );
        $config = get_addon_config ( 'WeixinArticle' );
        $this->assign ( 'data', $config );
        $this->display ();
    }
    function preview_cms() {
        $publicid = get_token_appinfo ( '', 'id' );
        $url = addons_url ( 'WeiSite://Wap/lists', array (
            'publicid' => $publicid,
            'from' => 'preview'
        ) );
        $this->assign ( 'url', $url );

        $this->display ();
    }

}
