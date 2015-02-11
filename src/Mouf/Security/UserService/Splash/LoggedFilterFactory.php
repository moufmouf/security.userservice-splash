<?php
namespace Mouf\Security\UserService\Splash;


use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Mouf\Mvc\Splash\Filters\FilterFactoryInterface;
use Mouf\Security\UserService\UserServiceInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Mouf\Security\UserService\Splash\Logged;

/**
 * Class in charge of creating the "logged" router, that is responsible for the @Logged annotation.
 */
class LoggedFilterFactory implements FilterFactoryInterface {

    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @param Reader $annotationReader The Doctrine annotation reader
     * @param UserServiceInterface $userService The user service to test login on.
     */
    public function __construct(Reader $annotationReader, UserServiceInterface $userService)
    {
        $this->annotationReader = $annotationReader;
        $this->userService = $userService;
    }

    /**
     * This should return a StackPHP middleware wrapping the $app.
     *
     * @param HttpKernelInterface $app The kernel your middleware will be wrapping.
     * @param object $controller The controller
     * @param string $action The action of the controller
     * @return HttpKernelInterface|null
     */
    public function getFilter(HttpKernelInterface $app, $controller, $action)
    {
        $reflectionClass = new \ReflectionClass(get_class($controller));
        $reflectionMethod = $reflectionClass->getMethod($action);

        $loggedAnnotation = $this->annotationReader->getClassAnnotation($reflectionClass, Logged::class);
        if ($loggedAnnotation === null) {
            $loggedAnnotation = $this->annotationReader->getMethodAnnotation($reflectionMethod, Logged::class);
        }
        if ($loggedAnnotation !== null) {
            return new LoggedFilter($app, $this->userService);
        } else {
            return null;
        }
    }
}
