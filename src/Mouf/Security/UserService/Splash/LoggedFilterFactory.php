<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 11/02/15
 * Time: 14:03
 */

namespace Mouf\Security\UserService\Splash;


use Mouf\Mvc\Splash\Filters\FilterFactoryInterface;
use Mouf\Security\UserService\UserServiceInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Class in charge of creating the "logged" router, that is responsible for the @Logged annotation.
 */
class LoggedFilterFactory implements FilterFactoryInterface {

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @param UserServiceInterface $userService The user service to test login on.
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * This should return a StackPHP middleware wrapping the $app.
     *
     * @param HttpKernelInterface $app The kernel your middleware will be wrapping.
     * @param object $controller The controller
     * @param string $action The action of the controller
     * @return HttpKernelInterface
     */
    public function getFilter(HttpKernelInterface $app, $controller, $action)
    {

    }
}