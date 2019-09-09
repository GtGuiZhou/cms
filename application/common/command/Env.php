<?php


namespace app\common\command;


use think\console\Command;
use think\console\Input;
use think\console\Output;

class Env extends Command
{
    protected function configure()
    {
        $this->setName('env')
            ->addArgument('envName')
            ->setDescription('Set Current System Env Status');
    }

    protected function execute(Input $input, Output $output)
    {
        $envName = $input->getArgument('envName');
        switch ($envName){
            case 'pro':
                $this->switchProductionEnv();
                break;
            case 'dev':
                $this->switchDevelopmentEnv();
                break;
            default:
                $output->writeln('未知环境');
        }
    }

    private function switchProductionEnv()
    {
        $proEnvFileName =  '.env_production';
        $runEnvFileName = '.env';
        $proEnvConfig = file_get_contents($proEnvFileName);
        file_put_contents($runEnvFileName,$proEnvConfig);

        if (file_get_contents($runEnvFileName) == file_get_contents($proEnvFileName))
            $this->output->writeln('切换至生产环境成功');
        else
            $this->output->writeln('切换至生产环境失败');
    }

    private function switchDevelopmentEnv()
    {
        $devEnvFileName =  '.env_development';
        $runEnvFileName = '.env';
        $proEnvConfig = file_get_contents($devEnvFileName);
        file_put_contents($runEnvFileName,$proEnvConfig);
        if (file_get_contents($runEnvFileName) == file_get_contents($devEnvFileName))
            $this->output->writeln('切换至生产环境成功');
        else
            $this->output->writeln('切换至生产环境失败');
    }
}