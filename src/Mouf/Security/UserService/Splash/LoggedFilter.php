<?php
namespace Mouf\Security\UserService\Splash;


use Mouf\Security\UserService\UserServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class LoggedFilter implements HttpKernelInterface {

    /**
     * @var HttpKernelInterface
     */
    private $app;

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @param HttpKernelInterface $app
     * @param UserServiceInterface $userService
     */
    function __construct(HttpKernelInterface $app, UserServiceInterface $userService)
    {
        $this->app = $app;
        $this->userService = $userService;
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
        // If we are logged, all is good, let's forward the request.
        if ($this->userService->isLogged()) {
            return $this->app->handle($request, $type, $catch);
        } else {
            // If we are not logged, let's redirect.
            // FIXME: we should instead return a response!!!
            $this->userService->redirectNotLogged();
            return null;
        }
    }
}
