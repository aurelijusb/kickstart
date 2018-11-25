<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/upload", name="upload")
     */
    public function upload(Request $request, KernelInterface $kernel)
    {
        // Parameters for upload files
        $webDir = $kernel->getRootDir() . '/../public';
        $uploadDir = $webDir . '/uploads';
        $this->ensureUploadDirectoryExists($uploadDir);
        $safeFileName = date('Y-m-d-H-i-s') . '.jpg'; // Assuming only one file field per request

        /** @var UploadedFile[] $files */
        $files = $request->files->all();
        foreach ($files as $file) {
            if (!in_array($file->getMimeType(), ['image/jpeg'])) {
                throw new BadRequestHttpException('We support only JPG images', null, 400);
            }

            // Moving file from temporary directory to normal one
            $file->move($uploadDir, $safeFileName);
        }

        return $this->render('home/index.html.twig', [
            'files' => $files,
            'uploadedFiles' => $this->uploadedFiles($webDir),
        ]);
    }

    private function ensureUploadDirectoryExists($uploadDir) {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    }

    /**
     * @return string[]
     */
    private function uploadedFiles($webDir)
    {
        return array_map('basename', glob("$webDir/uploads/*.jpg"));
    }
}
