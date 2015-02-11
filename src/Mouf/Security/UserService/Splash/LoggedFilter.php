<?php
namespace Mouf\Security\UserService\Splash;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class LoggedFilter implements HttpKernelInterface {

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var object
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @param UserServiceInterface $userService
     * @param object $controller
     * @param string $action
     */
    function __construct(UserServiceInterface $userService, $controller, $action)
    {
        $this->userService = $userService;
        $this->controller = $controller;
        $this->action = $action;
    }


    /**
     * Handles a Request to convert it to a Response.
     *
     * When $catch is true, the implementation must catch all exceptions
     * and do its best to convert them to a Response instance.
     *
     * @param Request $request A Request instance
     * @param int $type The type of the request
     *                         (one of HttpKernelInterface::MASTER_REQUEST or HttpKernelInterface::SUB_REQUEST)
     * @param bool $catch Whether to catch exceptions or not
     *
     * @return Response A Response instance
     *
     * @throws \Exception When an Exception occurs during processing
     *
     * @api
     */
    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {

    }
}