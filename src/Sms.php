<?php


namespace Faed\Alisms;




class Sms
{
    public $config = [];

    protected $params = [];


    public function __construct()
    {
        $config = app('config')->get('sms');

        if (!$config['access_key_id'] || !$config['access_key_secret'])
            throw new \RuntimeException('请检查配置参数【access_key_id】，【access_key_secret】不能为空');

        if (!$config['sign_group'] || !$config['template_group'])
            throw new \RuntimeException('请检查配置参数【sign_group】，【template_group】至少有一组');

        $this->params['SignName'] = $config['sign_group']['default'];

        $this->params['TemplateCode'] = $config['template_group']['default'];

        $this->config = $config;
    }


    /**
     *  设置发送短信流水号
     * @param mixed $outId
     */
    public function setOutId($outId): void
    {
        $this->params['OutId'] = $outId;
    }

    /**
     * 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
     * @param mixed $smsUpExtendCode
     */
    public function setSmsUpExtendCode($smsUpExtendCode): void
    {
        $this->params['SmsUpExtendCode'] = $smsUpExtendCode;
    }


    /**
     *  设置模板参数, 假如模板中存在变量需要替换则为必填项
     * @param mixed $templateParam
     */
    public function setTemplateParam(array $templateParam): void
    {
        $this->params['TemplateParam'] = json_encode($templateParam,JSON_UNESCAPED_UNICODE);
    }


    /**
     * 短信接收号码
     * @param mixed $PhoneNumbers
     */
    public function setPhoneNumbers($PhoneNumbers): void
    {
        $this->params['PhoneNumbers'] = $PhoneNumbers;
    }


    /**
     * 设置签名
     * @param $SignName
     */
    public function setSignName($SignName)
    {
        $this->params['SignName'] = $this->config['sign_group'][$SignName];
    }

    /**
     * 设置模板
     * @param $TemplateCode
     */
    public function setTemplateCode($TemplateCode)
    {
        $this->params['TemplateCode'] = $this->config['template_group'][$TemplateCode];
    }

    /**
     * @return bool
     */
    public function sendSms()
    {
        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper();

        return $helper->request($this->config['access_key_id'],$this->config['access_key_secret'],'dysmsapi.aliyuncs.com',array_merge($this->params,[
            'RegionId'=>$this->config['region_id'],
            'Version'=>$this->config['version'],
            'Action'=>'SendSms',
        ]),$this->config['security']);
    }
}
