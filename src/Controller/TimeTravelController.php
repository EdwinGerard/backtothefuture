<?php
/**
 * Created by PhpStorm.
 * User: aragorn
 * Date: 04/06/18
 * Time: 10:25
 */

namespace Controller;


use Model\TimeTravelManager;

class TimeTravelController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Exception
     */
    public function index()
    {
        $timeTravelManager = new TimeTravelManager();
        $info = $timeTravelManager->getTravelInfo();
        if (!empty($_POST)) {
            $data = $this->cleanPost($_POST);
            if (isset($data['interval'])) {
                $nb = $data['interval'];
            }

            if (preg_match('/^-?[0-9]*$/', $nb)) {
                if ($nb < 0) {
                    $nb = abs($nb);
                    $interval = new \DateInterval("PT".$nb."S");
                    $interval->invert = 1;
                }else {
                    $interval = new \DateInterval("PT".$nb."S");
                    $interval->invert = 0;
                }
                $doc = $timeTravelManager->findDate($interval);

                return $this->twig->render('BTF/index.html.twig', ['info' => $info, 'doc' => $doc]);
            }else {
                $error = 'Ce champ n\' est pas un nombre';
                return $this->twig->render('BTF/index.html.twig', ['info' => $info, 'error' => $error]);
            }

        }else {
            return $this->twig->render('BTF/index.html.twig', ['info' => $info]);
        }

    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Exception
     */
    public function step()
    {
        $timeTravelManager = new TimeTravelManager();
        if (!empty($_POST)) {
            $data = $this->cleanPost($_POST);
            if (isset($data[ 'step' ])) {
                $step = $data[ 'step' ];
            }
            if (preg_match('/^-?[0-9]*$/', $step)) {
                if ($step < 0) {
                    $step = abs($step);
                    $interval = new \DateInterval("PT" . $step . "S");
                    $interval->invert = 1;
                } else {
                    $interval = new \DateInterval("PT" . $step . "S");
                    $interval->invert = 0;
                }
            }
            $steps = $timeTravelManager->backToTheFutureStepByStep($interval);
            return $this->twig->render('BTF/steps.html.twig', ['steps' => $steps]);
        }
    }

}