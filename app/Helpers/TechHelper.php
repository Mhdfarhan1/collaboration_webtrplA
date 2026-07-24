<?php

namespace App\Helpers;

class TechHelper
{
    /**
     * Get predefined list of popular tech stacks with FontAwesome icon classes.
     */
    public static function getAllTechs(): array
    {
        return [
            'Laravel' => 'fa-brands fa-laravel text-red-500',
            'Tailwind CSS' => 'fa-solid fa-wind text-cyan-400',
            'Bootstrap' => 'fa-brands fa-bootstrap text-purple-600',
            'PHP' => 'fa-brands fa-php text-indigo-500',
            'MySQL' => 'fa-solid fa-database text-blue-600',
            'PostgreSQL' => 'fa-solid fa-database text-blue-500',
            'React' => 'fa-brands fa-react text-sky-400',
            'Vue.js' => 'fa-brands fa-vuejs text-emerald-500',
            'JavaScript' => 'fa-brands fa-js text-yellow-500',
            'TypeScript' => 'fa-brands fa-js text-blue-600',
            'Python' => 'fa-brands fa-python text-blue-500',
            'Node.js' => 'fa-brands fa-node-js text-green-600',
            'Express.js' => 'fa-solid fa-server text-emerald-600',
            'Next.js' => 'fa-brands fa-react text-slate-800',
            'Flutter' => 'fa-solid fa-mobile-screen-button text-sky-500',
            'Golang' => 'fa-solid fa-code text-cyan-600',
            'HTML5' => 'fa-brands fa-html5 text-orange-500',
            'CSS3' => 'fa-brands fa-css3-alt text-blue-500',
            'CodeIgniter' => 'fa-solid fa-fire text-orange-600',
            'Firebase' => 'fa-solid fa-fire text-amber-500',
            'MongoDB' => 'fa-solid fa-leaf text-emerald-600',
            'Docker' => 'fa-brands fa-docker text-sky-500',
            'Git' => 'fa-brands fa-git-alt text-orange-600',
            'Figma' => 'fa-brands fa-figma text-pink-500',
            'Android' => 'fa-brands fa-android text-emerald-500',
            'Java' => 'fa-brands fa-java text-orange-600',
        ];
    }

    /**
     * Render FontAwesome icon HTML.
     */
    public static function renderIcon($name, $sizeClass = 'text-xs'): string
    {
        $class = self::getIconClass($name);
        return '<i class="' . $class . ' ' . $sizeClass . '"></i>';
    }

    /**
     * Get CSS icon class for tech name.
     */
    public static function getIconClass($name): string
    {
        $nameLower = strtolower(trim($name));

        if (str_contains($nameLower, 'laravel')) {
            return 'fa-brands fa-laravel text-red-500';
        } elseif (str_contains($nameLower, 'tailwind')) {
            return 'fa-solid fa-wind text-cyan-400';
        } elseif (str_contains($nameLower, 'bootstrap')) {
            return 'fa-brands fa-bootstrap text-purple-600';
        } elseif (str_contains($nameLower, 'php')) {
            return 'fa-brands fa-php text-indigo-500';
        } elseif (str_contains($nameLower, 'mysql') || str_contains($nameLower, 'postgre') || str_contains($nameLower, 'sqlite') || str_contains($nameLower, 'sql')) {
            return 'fa-solid fa-database text-blue-600';
        } elseif (str_contains($nameLower, 'react')) {
            return 'fa-brands fa-react text-sky-400';
        } elseif (str_contains($nameLower, 'vue')) {
            return 'fa-brands fa-vuejs text-emerald-500';
        } elseif (str_contains($nameLower, 'javascript') || $nameLower === 'js') {
            return 'fa-brands fa-js text-yellow-500';
        } elseif (str_contains($nameLower, 'typescript') || $nameLower === 'ts') {
            return 'fa-brands fa-js text-blue-600';
        } elseif (str_contains($nameLower, 'python')) {
            return 'fa-brands fa-python text-blue-500';
        } elseif (str_contains($nameLower, 'node')) {
            return 'fa-brands fa-node-js text-green-600';
        } elseif (str_contains($nameLower, 'express')) {
            return 'fa-solid fa-server text-emerald-600';
        } elseif (str_contains($nameLower, 'next')) {
            return 'fa-brands fa-react text-slate-800';
        } elseif (str_contains($nameLower, 'flutter')) {
            return 'fa-solid fa-mobile-screen-button text-sky-500';
        } elseif (str_contains($nameLower, 'go') || str_contains($nameLower, 'golang')) {
            return 'fa-solid fa-code text-cyan-600';
        } elseif (str_contains($nameLower, 'html')) {
            return 'fa-brands fa-html5 text-orange-500';
        } elseif (str_contains($nameLower, 'css')) {
            return 'fa-brands fa-css3-alt text-blue-500';
        } elseif (str_contains($nameLower, 'codeigniter')) {
            return 'fa-solid fa-fire text-orange-600';
        } elseif (str_contains($nameLower, 'firebase')) {
            return 'fa-solid fa-fire text-amber-500';
        } elseif (str_contains($nameLower, 'mongo')) {
            return 'fa-solid fa-leaf text-emerald-600';
        } elseif (str_contains($nameLower, 'docker')) {
            return 'fa-brands fa-docker text-sky-500';
        } elseif (str_contains($nameLower, 'git')) {
            return 'fa-brands fa-git-alt text-orange-600';
        } elseif (str_contains($nameLower, 'figma')) {
            return 'fa-brands fa-figma text-pink-500';
        } elseif (str_contains($nameLower, 'android')) {
            return 'fa-brands fa-android text-emerald-500';
        } elseif (str_contains($nameLower, 'java')) {
            return 'fa-brands fa-java text-orange-600';
        }

        return 'fa-solid fa-code text-blue-500';
    }
}
