<?php

namespace app\common\model;
use think\Model;

class Groupbuy extends Model
{

    const GROUPBUY_STATE_REVIEW = 10;
    const GROUPBUY_STATE_NORMAL = 20;
    const GROUPBUY_STATE_REVIEW_FAIL = 30;
    const GROUPBUY_STATE_CANCEL = 31;
    const GROUPBUY_STATE_CLOSE = 32;
    public $page_info;
    private $groupbuy_state_array = array(
        0 => '全部', self::GROUPBUY_STATE_REVIEW => '审核中', self::GROUPBUY_STATE_NORMAL => '正常',
        self::GROUPBUY_STATE_CLOSE => '已结束', self::GROUPBUY_STATE_REVIEW_FAIL => '审核失败',
        self::GROUPBUY_STATE_CANCEL => '管理员关闭',
    );


    /**
     * 获取团购商品列表
     * @access public
     * @author csdeshang
     * @param array $condition 检索条件
     * @param int $page 分页信息
     * @param str $order 排序
     * @param str $field 字段
     * @return array
     */        
    public function getGroupbuyGoodsListAndGoodsList($condition, $page = null, $order = '', $field = '*')
    {
        $result = db('groupbuy')->alias('b')->field($field)->join('__GOODS__ g', 'b.goods_id=g.goods_id', 'RIGHT')->where($condition)->order($order)->paginate($page,false,['query' => request()->param()]);
        $this->page_info=$result;
        $result = $result->items();
        return $result;

    }
    /**
     * 获取团购商品
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @param type $page 分页
     * @param type $order 排序
     * @param type $field 字段
     * @param type $limit 限制
     * @return array
     */
    public function getGroupbuyGoodsExtendIds($condition, $page = null, $order = '', $field = 'goods_id', $limit = 0)
    {
        $groupbuy_goods_id_list = $this->getGroupbuyList($condition, $page, $order, $field, $limit);

        if (!empty($groupbuy_goods_id_list)) {
            for ($i = 0; $i < count($groupbuy_goods_id_list); $i++) {

                $groupbuy_goods_id_list[$i] = $groupbuy_goods_id_list[$i]['goods_id'];

            }
        }

        return $groupbuy_goods_id_list;
    }

    /**
     * 读取抢购列表
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getGroupbuyList($condition, $page = null, $order = 'state asc', $field = '*')
    {
        $result= db('groupbuy')->field($field)->where($condition)->order($order)->paginate($page,false,['query' => request()->param()]);
        $this->page_info=$result;
        return $result->items();
    }

    /**
     * 读取抢购列表
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @param string $limit 限制
     * @return array 抢购列表
     *
     */
    public function getGroupbuyExtendList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0)
    {
        $groupbuy_list = $this->getGroupbuyList($condition, $page, $order, $field, $limit);
        if (!empty($groupbuy_list)) {
            for ($i = 0, $j = count($groupbuy_list); $i < $j; $i++) {
                $groupbuy_list[$i] = $this->getGroupbuyExtendInfo($groupbuy_list[$i]);
            }
        }
        return $groupbuy_list;
    }

    /**
     * 读取可用抢购列表
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @return array
     */
    public function getGroupbuyAvailableList($condition)
    {
        $condition['state'] = array('in', array(self::GROUPBUY_STATE_REVIEW, self::GROUPBUY_STATE_NORMAL));
        return $this->getGroupbuyExtendList($condition);
    }

    /**
     * 查询抢购数量
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @return int
     */
    public function getGroupbuyCount($condition)
    {
        return db('groupbuy')->where($condition)->count();
    }

    /**
     * 读取当前可用的抢购列表
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getGroupbuyOnlineList($condition, $page = null, $order = 'state asc', $field = '*')
    {
        $condition['state'] = self::GROUPBUY_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        return $this->getGroupbuyExtendList($condition, $page, $order, $field);
    }

    /**
     * 读取即将开始的抢购列表
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getGroupbuySoonList($condition, $page = null, $order = 'state asc', $field = '*')
    {
        $condition['state'] = self::GROUPBUY_STATE_NORMAL;
        $condition['start_time'] = array('gt', TIMESTAMP);
        return $this->getGroupbuyExtendList($condition, $page, $order, $field);
    }

    /**
     * 读取已经结束的抢购列表
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getGroupbuyHistoryList($condition, $page = null, $order = 'state asc', $field = '*')
    {
        $condition['state'] = self::GROUPBUY_STATE_CLOSE;
        return $this->getGroupbuyExtendList($condition, $page, $order, $field);
    }

    /**
     * 读取推荐抢购列表
     * @access public
     * @author csdeshang
     * @param int $limit 要读取的数量
     * @return array 
     */
    public function getGroupbuyCommendedList($limit = 4)
    {
        $condition = array();
        $condition['state'] = self::GROUPBUY_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        return $this->getGroupbuyExtendList($condition, null, 'recommended desc', '*', $limit);
    }

    /**
     * 根据条件读取抢购信息
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @return array 抢购信息
     */
    public function getGroupbuyInfo($condition)
    {
        $groupbuy_info = db('groupbuy')->where($condition)->find();
        if (empty($groupbuy_info))
            return array();
        $groupbuy_info = $this->getGroupbuyExtendInfo($groupbuy_info);
        return $groupbuy_info;
    }

    /**
     * 根据条件读取抢购信息
     * @access public
     * @author csdeshang
     * @param array $condition 查询条件
     * @return array 抢购信息
     */
    public function getGroupbuyOnlineInfo($condition)
    {
        $condition['state'] = self::GROUPBUY_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $groupbuy_info = db('groupbuy')->where($condition)->find();
        return $groupbuy_info;
    }

    /**
     * 根据抢购编号读取抢购信息
     * @access public
     * @author csdeshang
     * @param array $groupbuy_id 抢购活动编号
     * @param int $store_id 如果提供店铺编号，判断是否为该店铺活动，如果不是返回null
     * @return array 抢购信息
     */
    public function getGroupbuyInfoByID($groupbuy_id, $store_id = 0)
    {
        if (intval($groupbuy_id) <= 0) {
            return null;
        }

        $condition = array();
        $condition['groupbuy_id'] = $groupbuy_id;
        $groupbuy_info = $this->getGroupbuyInfo($condition);

        if ($store_id > 0 && $groupbuy_info['store_id'] != $store_id) {
            return null;
        }
        else {
            return $groupbuy_info;
        }
    }

    /**
     * 根据商品编号查询是否有可用抢购活动，如果有返回抢购信息，没有返回null
     * @access public
     * @author csdeshang
     * @param type $goods_commonid 商品编号
     * @return array|null
     */
    public function getGroupbuyInfoByGoodsCommonID($goods_commonid)
    {
        $info = $this->_rGoodsGroupbuyCache($goods_commonid);
        if (empty($info)) {
            $condition = array();
            $condition['state'] = self::GROUPBUY_STATE_NORMAL;
            $condition['end_time'] = array('gt', TIMESTAMP);
            $condition['goods_commonid'] = $goods_commonid;
            $groupbuy_goods_list = $this->getGroupbuyExtendList($condition, null, 'start_time asc', '*', 1);
            $info['info'] = isset($groupbuy_goods_list[0])?serialize($groupbuy_goods_list[0]):serialize("");
            $this->_wGoodsGroupbuyCache($goods_commonid, $info);
        }
        $groupbuy_goods_info = unserialize($info['info']);
        if (!empty($groupbuy_goods_info) && ($groupbuy_goods_info['start_time'] > TIMESTAMP || $groupbuy_goods_info['end_time'] < TIMESTAMP)) {
            $groupbuy_goods_info = array();
        }
        return $groupbuy_goods_info;
    }

    /**
     * 根据商品编号查询是否有可用抢购活动，如果有返回抢购活动，没有返回null
     * @param type $goods_commonid_string 商品编号字符串，例：'1,22,33'
     * @return array|null
     */
    public function getGroupbuyListByGoodsCommonIDString($goods_commonid_string)
    {
        $groupbuy_list = $this->_getGroupbuyListByGoodsCommon($goods_commonid_string);
        $groupbuy_list = array_under_reset($groupbuy_list, 'goods_commonid');
        return $groupbuy_list;
    }

    /**
     * 根据商品编号查询是否有可用抢购活动，如果有返回抢购活动，没有返回null
     * @access public
     * @author csdeshang
     * @param type $goods_commonid_string 商品编号字符串
     * @return type
     */
    private function _getGroupbuyListByGoodsCommon($goods_commonid_string)
    {
        $condition = array();
        $condition['state'] = self::GROUPBUY_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $condition['goods_commonid'] = array('in', $goods_commonid_string);
        $xianshigoods_list = $this->getGroupbuyExtendList($condition, null, 'groupbuy_id desc', '*');
        return $xianshigoods_list;
    }

    /**
     * 抢购状态数组
     * @access public
     * @author csdeshang
     * @return type
     */
    public function getGroupbuyStateArray()
    {
        return $this->groupbuy_state_array;
    }

    /**
     * 增加
     * @access public
     * @author csdeshang
     * @param type $data 参数内容
     * @return boolean
     */
    public function addGroupbuy($data)
    {
        // 发布抢购锁定商品
        $this->_lockGoods($data['goods_commonid']);

        $data['state'] = self::GROUPBUY_STATE_REVIEW;
        $data['recommended'] = 0;
        $result = db('groupbuy')->insertGetId($data);
        if ($result) {
            // 更新商品抢购缓存
            $this->_dGoodsGroupbuyCache($data['goods_commonid']);
            return $result;
        }
        else {
            return false;
        }
    }

    /**
     * 锁定商品
     * @access private
     * @author csdeshang
     * @param type $goods_commonid 商品编号
     */
    private function _lockGoods($goods_commonid)
    {
        $condition = array();
        $condition['goods_commonid'] = $goods_commonid;

        $goods_model = model('goods');
        $goods_model->editGoodsCommonLock($condition);
    }

    /**
     * 解锁商品
     * @access private
     * @author csdeshang
     * @param type $goods_commonid 商品编号ID
     */
    private function _unlockGoods($goods_commonid)
    {
        $goods_model = model('goods');
        $goods_model->editGoodsCommonUnlock(array('goods_commonid' => $goods_commonid));
        // 添加对列 更新商品促销价格
        \mall\queue\QueueClient::push('updateGoodsPromotionPriceByGoodsCommonId', $goods_commonid);
    }

    /**
     * 更新
     * @access public
     * @author csdeshang
     * @param array $update 更新数据
     * @param array $condition 条件
     * @return bool
     */
    public function editGroupbuy($update, $condition)
    {
        $groupbuy_list = $this->getGroupbuyList($condition, null, '', 'goods_commonid');
        $result = db('groupbuy')->where($condition)->update($update);
        if ($result) {
            if (!empty($groupbuy_list)) {
                foreach ($groupbuy_list as $val) {
                    // 更新商品抢购缓存
                    $this->_dGoodsGroupbuyCache($val['goods_commonid']);
                }
            }
        }
        return $result;
    }

    /**
     * 审核成功
     * @access public
     * @author csdeshang
     * @param type $groupbuy_id 抢购ID
     * @return type
     */
    public function reviewPassGroupbuy($groupbuy_id)
    {
        $condition = array();
        $condition['groupbuy_id'] = $groupbuy_id;

        $update = array();
        $update['state'] = self::GROUPBUY_STATE_NORMAL;

        return $this->editGroupbuy($update, $condition);
    }

    /**
     * 审核失败
     * @access public
     * @author csdeshang
     * @param type $groupbuy_id 抢购ID
     * @return type
     */
    public function reviewFailGroupbuy($groupbuy_id)
    {
        // 商品解锁
        $groupbuy_info = $this->getGroupbuyInfoByID($groupbuy_id);

        $condition = array();
        $condition['groupbuy_id'] = $groupbuy_id;

        $update = array();
        $update['state'] = self::GROUPBUY_STATE_REVIEW_FAIL;

        $return = $this->editGroupbuy($update, $condition);
        if ($return) {
            $this->_unlockGoods($groupbuy_info['goods_commonid']);
        }
        return $return;
    }

    /**
     * 取消
     * @access public
     * @author csdeshang
     * @param int $groupbuy_id 抢购ID
     * @return bool
     */
    public function cancelGroupbuy($groupbuy_id)
    {
        // 商品解锁
        $groupbuy_info = $this->getGroupbuyInfoByID($groupbuy_id);

        $condition = array();
        $condition['groupbuy_id'] = $groupbuy_id;

        $update = array();
        $update['state'] = self::GROUPBUY_STATE_CANCEL;

        $return = $this->editGroupbuy($update, $condition);
        if ($return) {
            $this->_unlockGoods($groupbuy_info['goods_commonid']);
        }
        return $return;
    }

    /**
     * 过期抢购修改状态，解锁对应商品
     * @access public
     * @author csdeshang
     * @param type $condition 条件
     * @return boolean
     */
    public function editExpireGroupbuy($condition)
    {
        $condition['end_time'] = array('lt', TIMESTAMP);
        $condition['state'] = array('in', array(self::GROUPBUY_STATE_REVIEW, self::GROUPBUY_STATE_NORMAL));

        $expire_groupbuy_list = $this->getGroupbuyExtendList($condition, null);
        if (!empty($expire_groupbuy_list)) {
            $goodscommonid_array = array();
            foreach ($expire_groupbuy_list as $val) {
                $goodscommonid_array[] = $val['goods_commonid'];
            }
            // 更新商品促销价格，需要考虑抢购是否在进行中
            \mall\queue\QueueClient::push('updateGoodsPromotionPriceByGoodsCommonId', $goodscommonid_array);
        }
        $groupbuy_id_string = '';
        if (!empty($expire_groupbuy_list)) {
            foreach ($expire_groupbuy_list as $value) {
                $groupbuy_id_string .= $value['groupbuy_id'] . ',';
            }
        }

        if ($groupbuy_id_string != '') {
            $update = array();
            $update['state'] = self::GROUPBUY_STATE_CLOSE;
            $condition = array();
            $condition['groupbuy_id'] = array('in', rtrim($groupbuy_id_string, ','));
            $result = $this->editGroupbuy($update, $condition);
            if ($result) {
                foreach ($expire_groupbuy_list as $value) {
                    $this->_unlockGoods($value['goods_commonid']);
                }
            }
        }
        return true;
    }

    /**
     * 删除抢购活动
     * @access public
     * @author csdeshang
     * @param array $condition 条件
     * @return bool
     */
    public function delGroupbuy($condition)
    {
        $groupbuy_list = $this->getGroupbuyExtendList($condition);
        $result = db('groupbuy')->where($condition)->delete();

        if (!empty($groupbuy_list) && $result) {
            foreach ($groupbuy_list as $value) {
                // 商品解锁
                $this->_unlockGoods($value['goods_commonid']);
                // 更新商品抢购缓存
                $this->_dGoodsGroupbuyCache($value['goods_commonid']);

                list($base_name, $ext) = explode('.', $value['groupbuy_image']);
                list($store_id) = explode('_', $base_name);
                $path = BASE_UPLOAD_PATH . DS . ATTACH_GROUPBUY . DS . $store_id . DS;
                @unlink($path . $base_name . '.' . $ext);
                @unlink($path . $base_name . '_small.' . $ext);
                @unlink($path . $base_name . '_normal.' . $ext);
                @unlink($path . $base_name . '_big.' . $ext);

                if (!empty($value['groupbuy_image1'])) {
                    list($base_name, $ext) = explode('.', $value['groupbuy_image1']);
                    @unlink($path . $base_name . '.' . $ext);
                    @unlink($path . $base_name . '_small.' . $ext);
                    @unlink($path . $base_name . '_normal.' . $ext);
                    @unlink($path . $base_name . '_big.' . $ext);
                }
            }
        }
        return true;
    }

    /**
     * 获取抢购扩展信息
     * @access public
     * @author csdeshang
     * @param type $groupbuy_info 抢购信息
     * @return type
     */
    public function getGroupbuyExtendInfo($groupbuy_info)
    {
        $groupbuy_info['groupbuy_url'] = url('Home/Showgroupbuy/groupbuy_detail',['group_id'=>$groupbuy_info['groupbuy_id']]);
        $groupbuy_info['goods_url'] = url('Home/Goods/index',['goods_id'=>$groupbuy_info['goods_id']]);
        $groupbuy_info['start_time_text'] = date('Y-m-d H:i', $groupbuy_info['start_time']);
        $groupbuy_info['end_time_text'] = date('Y-m-d H:i', $groupbuy_info['end_time']);
        if (empty($groupbuy_info['groupbuy_image1'])) {
            $groupbuy_info['groupbuy_image1'] = $groupbuy_info['groupbuy_image'];
        }
        if ($groupbuy_info['start_time'] > TIMESTAMP && $groupbuy_info['state'] == self::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['groupbuy_state_text'] = '正常(未开始)';
        }
        elseif ($groupbuy_info['end_time'] < TIMESTAMP && $groupbuy_info['state'] == self::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['groupbuy_state_text'] = '已结束';
        }
        else {
            $groupbuy_info['groupbuy_state_text'] = $this->groupbuy_state_array[$groupbuy_info['state']];
        }

        if ($groupbuy_info['state'] == self::GROUPBUY_STATE_REVIEW) {
            $groupbuy_info['reviewable'] = 1;
        }
        else {
            $groupbuy_info['reviewable'] = 0;
        }

        if ($groupbuy_info['state'] == self::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['cancelable'] = 1;
        }
        else {
            $groupbuy_info['cancelable'] = 0;
        }

        switch ($groupbuy_info['state']) {
            case self::GROUPBUY_STATE_REVIEW:
                $groupbuy_info['state_flag'] = 'not-verify';
                $groupbuy_info['button_text'] = '未审核';
                break;
            case self::GROUPBUY_STATE_REVIEW_FAIL:
            case self::GROUPBUY_STATE_CANCEL:
            case self::GROUPBUY_STATE_CLOSE:
                $groupbuy_info['state_flag'] = 'close';
                $groupbuy_info['button_text'] = '已结束';
                break;
            case self::GROUPBUY_STATE_NORMAL:
                if ($groupbuy_info['start_time'] > TIMESTAMP) {
                    $groupbuy_info['state_flag'] = 'not-start';
                    $groupbuy_info['button_text'] = '未开始';
                    $groupbuy_info['count_down_text'] = '距抢购开始';
                    $groupbuy_info['count_down'] = $groupbuy_info['start_time'] - TIMESTAMP;
                }
                elseif ($groupbuy_info['end_time'] < TIMESTAMP) {
                    $groupbuy_info['state_flag'] = 'close';
                    $groupbuy_info['button_text'] = '已结束';
                }
                else {
                    $groupbuy_info['state_flag'] = 'buy-now';
                    $groupbuy_info['button_text'] = '我要抢';
                    $groupbuy_info['count_down_text'] = '距抢购结束';
                    $groupbuy_info['count_down'] = $groupbuy_info['end_time'] - TIMESTAMP;
                }
                break;
        }
        return $groupbuy_info;
    }

    /**
     * 读取商品抢购缓存
     * @access public
     * @author csdeshang
     * @param int $goods_commonid 商品id
     * @return array/bool
     */
    private function _rGoodsGroupbuyCache($goods_commonid)
    {
        return rcache($goods_commonid, 'goods_groupbuy');
    }

    /**
     * 写入商品抢购缓存
     * @access public
     * @author csdeshang
     * @param int $goods_commonid 商品id
     * @param array $info 商品信息
     * @return boolean
     */
    private function _wGoodsGroupbuyCache($goods_commonid, $info)
    {
        return wcache($goods_commonid, $info, 'goods_groupbuy');
    }

    /**
     * 删除商品抢购缓存
     * @access public
     * @author csdeshang
     * @param int $goods_commonid 商品id
     * @return boolean
     */
    private function _dGoodsGroupbuyCache($goods_commonid)
    {
        return dcache($goods_commonid, 'goods_groupbuy');
    }

    /**
     * 读取抢购分类
     * @access public
     * @author csdeshang
     * @return array
     */
    public function getGroupbuyClasses()
    {
        return $this->getCachedData('groupbuy_classes');
    }

    /**
     * 读取虚拟抢购分类
     * @access public
     * @author csdeshang
     * @return array
     */
    public function getGroupbuyVrClasses()
    {
        return $this->getCachedData('groupbuy_vr_classes');
    }


    /**
     * 删除缓存
     * @access public
     * @author csdeshang
     * @param string $key 缓存键
     */
    public function dropCachedData($key)
    {
        unset($this->cachedData[$key]);
        dkcache($key);
    }

    /**
     * 获取缓存
     * @access public
     * @author csdeshang
     * @param string $key 缓存键
     * @return array 缓存数据
     */
    protected function getCachedData($key)
    {

        $data = @$this->cachedData[$key];

        // 属性中存在则返回
        if ($data || is_array($data)) {
            return $data;
        }

        $data = rkcache($key);

        // 缓存中存在则返回
        if ($data || is_array($data)) {
            // 写入属性
            $this->cachedData[$key] = $data;
            return $data;
        }

        $data = $this->getCachingDataByQuery($key);

        // 写入缓存
        wkcache($key, $data);

        // 写入属性
        $this->cachedData[$key] = $data;

        return $data;
    }
    /**
     * 获取缓存数据查询
     * @access public
     * @author csdeshang
     * @param type $key 缓存键
     * @return type
     */
    protected function getCachingDataByQuery($key)
    {
        $data = array();

        switch ($key) {
            case 'groupbuy_classes': // 抢购分类
                $classes = db('groupbuyclass')->order('gclass_sort asc')->select();
                foreach ((array)$classes as $v) {
                    $id = $v['gclass_id'];
                    $pid = $v['gclass_parent_id'];
                    $data['name'][$id] = $v['gclass_name'];
                    $data['parent'][$id] = $pid;
                    $data['children'][$pid][] = $id;
                }
                break;

            case 'groupbuy_vr_classes': // 虚拟抢购分类
                $classes = db('vrgroupbuyclass')->order('vrgclass_sort asc')->select();
                foreach ((array)$classes as $v) {
                    $id = $v['vrgclass_id'];
                    $pid = $v['vrgclass_parent_id'];
                    $data['name'][$id] = $v['vrgclass_name'];
                    $data['parent'][$id] = $pid;
                    $data['children'][$pid][] = $id;
                }
                break;
            default:
                exception("Invalid data key: {$key}");
        }

        return $data;
    }

    /**
     * 缓存数据（抢购分类、虚拟抢购分类、虚拟抢购地区）
     * 数组键为缓存名称 值为缓存数据
     *
     * 例 抢购分类缓存数据格式如下
     * array(
     *   'name' => array(
     *     '分类id' => '分类名称',
     *     // ..
     *   ),
     *   'parent' => array(
     *     '子分类id' => '父分类id',
     *     // ..
     *   ),
     *   'children' => array(
     *     '父分类id' => array(
     *       '子分类id 1',
     *       '子分类id 2',
     *       // ..
     *     ),
     *     // ..
     *   ),
     * )
     *
     * @return array
     */
    protected $cachedData;

}

?>