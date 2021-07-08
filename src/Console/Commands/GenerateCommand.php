<?php

namespace Chowjiawei\Helpers\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

class GenerateCommand extends GeneratorCommand
{
    /**
     * 控制台命令 signature 的名称。
     *
     * @var string
     */
    protected $signature = 'generate {name} {--model :  是否为模型} {--controller :  是否为控制器}';

    /**
     * 控制台命令说明。
     *
     * @var string
     */
    protected $description = 'Generate Code';

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @var Composer
     */
    protected $composer;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $time;

    const BASE_PATH = 'App' . DIRECTORY_SEPARATOR;

    const SERVICE_PATH = self::BASE_PATH . 'Services';

    const MODEL_PATH = self::BASE_PATH . 'Models';

    const CONTROLLER_PATH = self::BASE_PATH . 'Http/Controllers';

    /**
     * Author: WangSx
     * DateTime: 2019-11-28 13:07
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name = strtolower($this->argument('name'));
        if ($name !== 'dingtalk') {


            $isModel = $this->option('model');

            $isController = $this->option('controller');


            if (!$isModel && !$isController) {
                $this->error("必须指定一个类型");
                return true;
            }
            if ($isController) {
                $result = $this->generateName($name, 'controller');
            }
            if ($isModel) {
                $result = $this->generateName($name, 'model');
            }
            $name = $result[0];

            $path = $result[1];

            if (!$this->files->isDirectory($path)) {
                $this->files->makeDirectory($path, 0755, true, true);
            }

            $this->files = new Filesystem();
            $this->composer = new Composer($this->files);
            $this->date = date('Y-m-d');
            $this->time = date('H:i');

            $nameSpace = str_replace('/', '\\', $path);
            $stub = $this->files->get($this->getStub());
            if ($isController) {

                $templateData = [
                    'date' => $this->date,
                    'time' => $this->time,
                    'className' => $name . 'Controller',
                    'nameSpace' => $nameSpace,
                ];

                $renderStub = $this->getRenderStub($templateData, $stub);
                $path .= DIRECTORY_SEPARATOR . $name . 'Controller.php';
            }
            if ($isModel) {
                $templateData = [
                    'date' => $this->date,
                    'time' => $this->time,
                    'className' => $name,
                    'nameSpace' => $nameSpace,
                ];

                $renderStub = $this->getRenderStub($templateData, $stub);
                $path .= DIRECTORY_SEPARATOR . $name . '.php';
            }

            $path = lcfirst($path);
            if (!$this->files->exists($path)) {

                $this->files->put($path, $renderStub);

                $filename = substr(strrchr($path, "/"), 1);
                $this->info('create : ' . $filename . '  success');
            } else {
                $filename = substr(strrchr($path, "/"), 1);
                $this->info('The file : ' . $filename . '  already exists');
            }
            return true;
        }
        if ($name == 'dingtalk') {
            $path = 'app/Notifications/DingtalkRobotNotification.php';
            $stub = $this->files->get($this->getStub());
        }

        if ($name == 'Wechat') {
            $path = 'app/Notifications/WechatNotification.php';
            $stub = $this->files->get($this->getStub());
        }

        if ($name == 'WechatTemplateMessageNotification') {
            $path = 'app/Notifications/WechatTemplateMessageNotification.php';
            $stub = $this->files->get($this->getStub());
        }


        if (!$this->files->exists($path)) {

            $this->files->put($path, $stub);

            $filename = substr(strrchr($path, "/"), 1);
            $this->info('create : ' . $filename . '  success');
        } else {
            $filename = substr(strrchr($path, "/"), 1);
            $this->info('The file : ' . $filename . '  already exists');
        }
        return true;
    }

    protected function getRenderStub($templateData, $stub)
    {

        foreach ($templateData as $search => $replace) {
            $stub = str_replace('$' . $search, $replace, $stub);
        }

        return $stub;
    }

    protected function getStub()
    {
        if ($this->option('controller')) {
            return dirname(__DIR__) . '/stubs/Controller.stub';
        }
        if ($this->option('model')) {
            return dirname(__DIR__) . '/stubs/Model.stub';
        }

        if ($this->argument('name') == 'dingtalk') {
            return dirname(__DIR__) . '/stubs/DingtalkRobotNotification.stub';
        }

    }


    public function generateName($name, $type)
    {
        $nameArr = explode('/', $name);

        $nameCount = count($nameArr);
        if ($type == 'controller') {
            $path = self::CONTROLLER_PATH;
        }
        if ($type == 'model') {
            $path = self::MODEL_PATH;
        }

        if ($nameCount > 1) {
            for ($i = 0; $i < $nameCount - 1; $i++) {

                $path .= DIRECTORY_SEPARATOR . ucfirst($nameArr[$i]);
            }
        }

        return [ucfirst(end($nameArr)), $path];
    }
}
