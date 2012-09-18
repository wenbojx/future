<?php
class tools{
    /**
     * 从google地图转换为百度地图坐标
     * @param array $latlng
     * @return array 失败返回cur错误信息
     */
    public static function convert($latlng) {
        $result = array();
        apf_require_class('APF_Http_Client_Curl');
        $curl = new APF_Http_Client_Curl();
        $url = "http://api.map.baidu.com/ag/coord/convert?from=2&to=4&x={$latlng['glng']}&y={$latlng['glat']}";
        $curl->set_url($url);
        $rs = $curl->execute();
        if($rs) {
            $response = $curl->get_response_text();
            $rt = json_decode($response, true);
            if($rt['error'] == 0) {
                $result['blng'] = base64_decode($rt['x']);
                $result['blat'] = base64_decode($rt['y']);
                return $result;
            }
        } else {
            return -1;
        }
    }
}