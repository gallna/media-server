<?php
namespace Kemer\UPnPServer\MediaServer\ConnectionManager;

use SimpleXmlElement;

class ConnectionManager
{

    public function __construct()
    {

    }

    public function GetProtocolInfo()
    {
        return [
            "Source" => "http-get:*:video/x-ms-asf:DLNA.ORG_PN=MPEG4_P2_ASF_ASP_L4_SO_G726,http-get:*:video/x-ms-wmv:DLNA.ORG_PN=WMVMED_PRO,http-get:*:image/jpeg:DLNA.ORG_PN=JPEG_TN,http-get:*:audio/x-ms-wma:DLNA.ORG_PN=WMAFULL,http-get:*:video/x-ms-asf:DLNA.ORG_PN=VC1_ASF_AP_L1_WMA,http-get:*:image/jpeg:DLNA.ORG_PN=JPEG_SM,http-get:*:audio/L16;rate=44100;channels=2:DLNA.ORG_PN=LPCM,http-get:*:video/x-ms-wmv:DLNA.ORG_PN=WMVMED_BASE,http-get:*:video/x-ms-wmv:DLNA.ORG_PN=WMVSPML_MP3,http-get:*:audio/x-ms-wma:DLNA.ORG_PN=WMABASE,http-get:*:video/mpeg:DLNA.ORG_PN=MPEG_PS_PAL,http-get:*:video/x-ms-wmv:DLNA.ORG_PN=WMVHIGH_FULL,http-get:*:video/mpeg:DLNA.ORG_PN=MPEG_PS_PAL_XAC3,http-get:*:image/jpeg:DLNA.ORG_PN=JPEG_MED,http-get:*:video/x-ms-asf:DLNA.ORG_PN=MPEG4_P2_ASF_SP_G726,http-get:*:audio/L16;rate=48000;channels=2:DLNA.ORG_PN=LPCM,http-get:*:audio/mpeg:DLNA.ORG_PN=MP3,http-get:*:video/x-ms-wmv:DLNA.ORG_PN=WMVHIGH_PRO,http-get:*:audio/mpeg:DLNA.ORG_PN=MP3X,http-get:*:video/x-ms-asf:DLNA.ORG_PN=MPEG4_P2_ASF_ASP_L5_SO_G726,http-get:*:video/x-ms-wmv:DLNA.ORG_PN=WMVSPLL_BASE,http-get:*:video/mpeg:DLNA.ORG_PN=MPEG_PS_NTSC,http-get:*:video/mpeg:DLNA.ORG_PN=MPEG1,http-get:*:video/x-ms-wmv:DLNA.ORG_PN=WMVSPML_BASE,http-get:*:video/x-ms-wmv:DLNA.ORG_PN=WMVMED_FULL,http-get:*:audio/x-ms-wma:DLNA.ORG_PN=WMAPRO,http-get:*:image/jpeg:DLNA.ORG_PN=JPEG_LRG,http-get:*:video/mpeg:DLNA.ORG_PN=MPEG_PS_NTSC_XAC3,http-get:*:audio/L16;rate=44100;channels=1:DLNA.ORG_PN=LPCM,http-get:*:image/x-ycbcr-yuv420:*,http-get:*:video/x-ms-wmv:*,http-get:*:audio/x-ms-wma:*,http-get:*:video/wtv:*,rtsp-rtp-udp:*:video/x-ms-asf:DLNA.ORG_PN=MPEG4_P2_ASF_SP_G726,rtsp-rtp-udp:*:video/x-ms-wmv:DLNA.ORG_PN=WMVMED_PRO,rtsp-rtp-udp:*:video/x-ms-asf:DLNA.ORG_PN=MPEG4_P2_ASF_ASP_L5_SO_G726,rtsp-rtp-udp:*:video/x-ms-asf:DLNA.ORG_PN=MPEG4_P2_ASF_ASP_L4_SO_G726,rtsp-rtp-udp:*:video/x-ms-wmv:DLNA.ORG_PN=WMVSPLL_BASE,rtsp-rtp-udp:*:video/x-ms-wmv:DLNA.ORG_PN=WMVSPML_BASE,rtsp-rtp-udp:*:video/x-ms-wmv:DLNA.ORG_PN=WMVHIGH_PRO,rtsp-rtp-udp:*:video/x-ms-wmv:DLNA.ORG_PN=WMVMED_FULL,rtsp-rtp-udp:*:video/x-ms-asf:DLNA.ORG_PN=VC1_ASF_AP_L1_WMA,rtsp-rtp-udp:*:video/x-ms-wmv:DLNA.ORG_PN=WMVMED_BASE,rtsp-rtp-udp:*:video/x-ms-wmv:DLNA.ORG_PN=WMVHIGH_FULL,rtsp-rtp-udp:*:video/x-ms-wmv:DLNA.ORG_PN=WMVSPML_MP3,rtsp-rtp-udp:*:video/x-ms-wmv:*",
            "Sink" => ""
        ];
    }

    public function PrepareForConnection()
    {

    }

    public function ConnectionComplete($url)
    {

    }

    public function GetCurrentConnectionIDs()
    {

    }

    public function GetCurrentConnectionInfo()
    {

    }
}
