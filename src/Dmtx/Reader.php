<?php

namespace Dmtx;

use Symfony\Component\OptionsResolver\OptionsResolver;

class Reader extends AbstractDmtx
{
    /**
     * @var string[]
     *
     * @psalm-var array{0: 'newline', 1: 'unicode', 2: 'milliseconds', 3: 'codewords', 4: 'minimum-edge', 5: 'maximum-edge', 6: 'gap', 7: 'page', 8: 'square-deviation', 9: 'resolution', 10: 'symbol-size', 11: 'threshold', 12: 'x-range-min', 13: 'x-range-max', 14: 'y-range-min', 15: 'y-range-max', 16: 'corrections-max', 17: 'diagnose', 18: 'mosaic', 19: 'stop-after', 20: 'page-numbers', 21: 'corners', 22: 'shrink'}
     */
    protected array $arguments = [
        'newline',
        'unicode',
        'milliseconds',
        'codewords',
        'minimum-edge',
        'maximum-edge',
        'gap',
        'page',
        'square-deviation',
        'resolution',
        'symbol-size',
        'threshold',
        'x-range-min',
        'x-range-max',
        'y-range-min',
        'y-range-max',
        'corrections-max',
        'diagnose',
        'mosaic',
        'stop-after',
        'page-numbers',
        'corners',
        'shrink'
    ];

    /**
     * @return void
     */
    protected function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'unicode' => true,
            'milliseconds' => 200,
            'symbol-size' => 'square-auto',
            'process-timeout' => 600,
            'command' => 'dmtxread'
        ]);

        $resolver->setDefined([
            'newline',
            'unicode',
            'milliseconds',
            'codewords',
            'minimum-edge',
            'maximum-edge',
            'gap',
            'page',
            'square-deviation',
            'resolution',
            'symbol-size',
            'threshold',
            'x-range-min',
            'x-range-max',
            'y-range-min',
            'y-range-max',
            'corrections-max',
            'diagnose',
            'mosaic',
            'stop-after',
            'page-numbers',
            'corners',
            'shrink'
        ]);

        $allowedValues = [
            'symbol-size' => [
                'square-auto',
                'rectangle-auto',
                '10x10',
                '24x24',
                '64x64'
            ],
        ];
        foreach ($allowedValues as $option => $allowedValue) {
            $resolver->setAllowedValues($option, $allowedValue);
        }

        $allowedTypes = [
            'newline' => 'bool',
            'unicode' => 'bool',
            'milliseconds' => 'integer',
            'codewords' => 'bool',
            'minimum-edge' => 'integer',
            'maximum-edge' => 'integer',
            'gap' => 'integer',
            'page' => 'integer',
            'square-deviation' => 'integer',
            'resolution' => 'integer',
            'threshold' => 'integer',
            'corrections-max' => 'integer',
            'diagnose' => 'bool',
            'mosaic' => 'bool',
            'stop-after' => 'integer',
            'page-numbers' => 'bool',
            'corners' => 'bool',
            'shrink' => 'integer'
        ];
        foreach ($allowedTypes as $option => $allowedType) {
            $resolver->setAllowedTypes($option, $allowedTypes);
        }
    }

    public function decode($encoded_string)
    {
        return $this->run(
            $this->getCmd(),
            $encoded_string
        );
    }

    public function decodeFile($filename)
    {
        return $this->run(
            $this->getCmd(),
            file_get_contents($filename)
        );
    }


    public function process()
    {
        return $this->getProcess(
            $this->getCmd()
        );
    }
}
