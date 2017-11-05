<?php
namespace TotalVoice\Audio;

use TotalVoice\Route;
use TotalVoice\ClientInterface;

class AudioService
{
    /**
     * @var string
     */
    const ROTA_AUDIO = '/audio/';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Service constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Envia um audio para um número destino
     * @param string $numeroDestino
     * @param string $urlAudio
     * @param bool $respostaUsuario
     * @param string $bina
     * @return mixed
     */
    public function enviar($numeroDestino, $urlAudio, $respostaUsuario = false, $bina = null)
    {
        return $this->client->post(
            new Route([self::ROTA_AUDIO]), [
                'numero_destino'    => $numeroDestino,
                'url_audio'         => $urlAudio,
                'resposta_usuario'  => $respostaUsuario,
                'bina'              => $bina
            ]
        );
    }

    /**
     * Busca um audio pelo seu ID
     * @param $id
     * @return string
     */
    public function buscaAudio($id)
    {
        return $this->client->get(new Route([self::ROTA_AUDIO, $id]));
    }

    /**
     * Relatório de mensagens de Audios
     * @param \DateTime $dataInicio
     * @param \DateTime $dataFinal
     * @return string
     */
    public function relatorio(\DateTime $dataInicio, \DateTime $dataFinal)
    {
        return $this->client->get(
            new Route([self::ROTA_AUDIO, 'relatorio']), [
            'data_inicio' => $dataInicio->format('d/m/Y'),
            'data_fim'    => $dataFinal->format('d/m/Y')
        ]);
    }
}