<?php
require_once 'Tools.php';

/**
 * Facebook Request Dialog is used to invite friends to start using an application, 
 * or to send request for some specific action to application users.
 */
class RequestDialog
{
    /**
     * Function sets the type of the command control.
	 * Allowed values are 'link', 'button' and 'auto'. Default value is 'button'.
     * @param <string> $commandType
     */
	public function SetCommandType($commandType) 
    {
        if ($commandType != "button" && $commandType != "link" && $commandType != 'auto')
        {
            throw new Exception("StreamPublish Error:  Unsuported command type: " . $commandType);
        }
        $this->commandType = $commandType;
    }

    /**
     * Function sets the title of a request button/link. Default value is 'Send Request'.
     * @param <string> $commandText
     */
    public function SetCommandText($commandText) {$this->commandText = $commandText;}

    /**
     * Function sets the message of the request dialog.
     * @param <string> $name
     */
    public function SetMessage($message) {$this->message = $message;}

    /**
     * Function sets the title of the request dialog.
     * @param <string> $nameUrl
     */
    public function SetTitle($nameUrl) {$this->title = $title;}

    /**
     * Function sets the additional data of request dialog.
     * @param <string> $caption
     */
    public function SetAdditionalData($additionalData) {$this->additionalData = $additionalData;}

    /**
     * Function sets the friend ID. If it's set, the request will be sent just to this friend.
     * @param <string> $friendId
     */
    public function SetFriendId($friendId) {$this->friendId = $friendId;}

    /**
     * Function sets the CSS style of the button/link.
     * @param <string> $cssStyle
     */
    public function SetCssStyle($cssStyle) {$this->cssStyle = $cssStyle;}

    /**
     * Function sets the CSS class of the button/link.
     * @param <string> $cssClass
     */
    public function SetCssClass($cssClass) {$this->cssClass = $cssClass;}

    /**
    * Get html for creating of this component, depending on defined settings.
    * @return string html
    */
    public function GetOutputHtml()
    {
        $functionName = "ShowRequestDialog" . GlobalCounter::GetCount();
        $html = "<script>\n";
        $html .= "function " . $functionName . "() {\n";
        $html .= "  if (graphApiInitialized != true) {\n";
        $html .= "    setTimeout('" . $functionName . "()', 100);\n";
        $html .= "    return;\n";
        $html .= "  }\n";
        $html .= "  FB.ui({method: 'apprequests', message: '";
        $html .= $this->message . "'";
        if ($this->title != null)
        {
            $html .= ", title: '" . $this->title . "'";
        }
        if ($this->friendId != null)
        {
            $html .= ", to: '" . $this->friendId . "'";
        }
        if ($this->additionalData != null)
        {
            $html .= ", data: '" . $this->additionalData . "'";
        }
        $html .= "});\n";
        $html .= "}\n";
        $html .= "</script>\n";

        switch ($this->commandType)
        {
            case "link":
                $html .= "<a style='cursor:pointer;" . $this->cssStyle . "' class='" . $this->cssClass . "' onclick=\"" . $functionName . "()\" >";
                $html .= $this->commandText;
                $html .= "</a>\n";
                break;
            case "button":
                $html .= "<input type='button' style='" . $this->cssStyle . "' class='" . $this->cssClass . "' onclick=\"" . $functionName . "()\"  value=\"";
                $html .= $this->commandText;
                $html .= "\" />\n";
                break;
            case "auto":
                $html .= "<script type=\"text/javascript\">";
                $html .= $functionName . "();\n";
                $html .= "</script>\n";
                break;
            default:
                throw new Exception('Request Dialog Control Error:  Unsupported Command Type: ' . $this->commandType);
        }
        return $html;
    }

    /**
     * Function renders component on the web page, depending on defined settings.
     */
    public function Render()
    {
        echo $this->GetOutputHtml();
    }

    // Private members
    private $commandType = "button";
    private $commandText = "Send Request";
    private $message = null;
    private $title = null;
    private $friendId = null;
    private $additionalData = null;
    private $cssStyle = null;
    private $cssClass = null;
}

?>
