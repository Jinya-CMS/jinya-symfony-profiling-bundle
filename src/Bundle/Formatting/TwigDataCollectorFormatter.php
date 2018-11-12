<?php
/**
 * Created by PhpStorm.
 * User: imanuel
 * Date: 02.11.18
 * Time: 00:23
 */

namespace Jinya\Profiling\Bundle\Formatting;

use Symfony\Bridge\Twig\DataCollector\TwigDataCollector;
use Twig\Profiler\Profile;

class TwigDataCollectorFormatter implements TwigDataCollectorFormatterInterface
{
    /**
     * Formats the doctrine data into a profiling array
     *
     * @param TwigDataCollector $collector
     * @return array
     */
    public function format(TwigDataCollector $collector): array
    {
        return $this->formatTwigProfile($collector->getProfile());
    }

    private function formatTwigProfile(Profile $twigProfile): array
    {
        return [
            'template' => $twigProfile->getName(),
            'memoryUsage' => $twigProfile->getMemoryUsage(),
            'peakMemoryUsage' => $twigProfile->getPeakMemoryUsage(),
            'duration' => $twigProfile->getDuration(),
            'profiles' => array_map([$this, 'formatTwigProfile'], $twigProfile->getProfiles()),
        ];
    }
}
