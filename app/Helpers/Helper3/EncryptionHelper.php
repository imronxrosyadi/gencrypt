<?php

namespace App\Helpers;

class EncryptionHelper
{
    private $key;
    private $blockSize = 16; // Block size for AES is 16 bytes.
    public function __construct($key)
    {
        if (strlen($key) !== 32) {
            throw new \Exception("The encryption key must be 32 bytes long.");
        }
        $this->key = $key;
    }
    public function encrypt($plaintext)
    {
        $paddedText = $this->pkcs7Pad($plaintext);
        $blocks = str_split($paddedText, $this->blockSize);
        $ciphertext = '';

        $keys = $this->keyExpansion();

        foreach ($blocks as $block) {
            $ciphertext .= $this->encryptBlock($block, $keys);
        }

        return base64_encode($ciphertext);
    }

    public function decrypt($ciphertext)
    {
        $ciphertext = base64_decode($ciphertext);
        $blocks = str_split($ciphertext, $this->blockSize);
        $plaintext = '';

        $keys = $this->keyExpansion();

        foreach ($blocks as $block) {
            $plaintext .= $this->decryptBlock($block, $keys);
        }

        return $this->pkcs7Unpad($plaintext);
    }

    private function encryptBlock($block, $keys)
    {
        $state = $this->stringToMatrix($block);

        // Initial round
        $state = $this->addRoundKey($state, $keys[0]);

        // 13 full rounds for AES-256
        for ($round = 1; $round < 14; $round++) {
            $state = $this->subBytes($state);
            $state = $this->shiftRows($state);
            $state = $this->mixColumns($state);
            $state = $this->addRoundKey($state, $keys[$round]);
        }

        // Final round (no MixColumns)
        $state = $this->subBytes($state);
        $state = $this->shiftRows($state);
        $state = $this->addRoundKey($state, $keys[14]);

        return $this->matrixToString($state);
    }

    private function decryptBlock($block, $keys)
    {
        $state = $this->stringToMatrix($block);

        // Initial round
        $state = $this->addRoundKey($state, $keys[14]);
        $state = $this->inverseShiftRows($state);
        $state = $this->inverseSubBytes($state);

        // 13 full rounds for AES-256
        for ($round = 13; $round > 0; $round--) {
            $state = $this->addRoundKey($state, $keys[$round]);
            $state = $this->inverseMixColumns($state);
            $state = $this->inverseShiftRows($state);
            $state = $this->inverseSubBytes($state);
        }

        // Final round (no InverseMixColumns)
        $state = $this->addRoundKey($state, $keys[0]);

        return $this->matrixToString($state);
    }

    private function pkcs7Pad($data)
    {
        $padLength = $this->blockSize - (strlen($data) % $this->blockSize);
        return $data . str_repeat(chr($padLength), $padLength);
    }

    private function pkcs7Unpad($data)
    {
        $padLength = ord($data[strlen($data) - 1]);
        return substr($data, 0, -$padLength);
    }

    private function stringToMatrix($string)
    {
        $matrix = [];
        for ($i = 0; $i < 16; $i++) {
            $matrix[$i % 4][$i >> 2] = ord($string[$i]);
        }
        return $matrix;
    }

    private function matrixToString($matrix)
    {
        $string = '';
        for ($i = 0; $i < 16; $i++) {
            $string .= chr($matrix[$i % 4][$i >> 2]);
        }
        return $string;
    }

    private function addRoundKey($state, $key)
    {
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $state[$i][$j] ^= $key[$i][$j];
            }
        }
        return $state;
    }

    private function subBytes($state)
    {
        // Apply Rijndael S-box substitution to each byte in the state
        // Placeholder: replace with actual S-box implementation
        return $state;
    }

    private function shiftRows($state)
    {
        // Apply row shifts
        // Placeholder: implement row shift logic
        return $state;
    }

    private function mixColumns($state)
    {
        // Apply MixColumns transformation
        // Placeholder: implement MixColumns logic
        return $state;
    }

    private function keyExpansion()
    {
        // Expand the key into 14 round keys
        // Placeholder: implement AES-256 key expansion logic
        return [];
    }

    private function inverseSubBytes($state)
    {
        // Apply inverse Rijndael S-box substitution to each byte in the state
        // Placeholder: replace with actual inverse S-box implementation
        return $state;
    }

    private function inverseShiftRows($state)
    {
        // Apply inverse row shifts
        // Placeholder: implement inverse row shift logic
        return $state;
    }

    private function inverseMixColumns($state)
    {
        // Apply InverseMixColumns transformation
        // Placeholder: implement InverseMixColumns logic
        return $state;
    }
}
