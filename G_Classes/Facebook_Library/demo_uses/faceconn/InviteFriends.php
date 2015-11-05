<?php

require_once 'AppConfig.php';

/**
 * Facebook Invite control is used to send the invite requests to the user's friends,
 * to use Facebook application or Facebook Connect website.
 */
class InviteFriends
{
    /**
     * Function sets the URL where application should be redirected, after an invitation is sent.
     * Default is application Canvas URL taken from AppConfig class
     * @param <string> $actionUrl
     */
    public function SetActionUrl($actionUrl) {$this->actionUrl = $actionUrl;}

    /**
     * Function sets the URL where user will be redirected after the invite request is accepted. 
	 * If it's not set, ActionUrl is used.
     * @param <string> $acceptUrl
     */
    public function SetAcceptUrl($acceptUrl) {$this->acceptUrl = $acceptUrl;}

    /**
     * Function sets the description which should be displayed on the invite request.
     * @param <string> $content
     */
    public function SetContent($content) {$this->content = $content;}

    /**
     * Function sets the name of application. Default is name taken from AppConfig class
     * @param <string> $appName
     */
    public function SetAppName($appName) {$this->appName = $appName;}

    /**
     * Function sets the text of the confirm button. Default value is 'Accept'.
     * @param <string> $confirmButtonText
     */
    public function SetConfirmButtonText($confirmButtonText) {$this->confirmButtonText = $confirmButtonText;}

    /**
     * Function sets the title of message inside the invite control.
     * @param <string> $mainTitle
     */
    public function SetMainTitle($mainTitle) {$this->actionText = $mainTitle;}

    /**
     * Call this function with the parameter set to true to display the border. Default value is true.
     * @param <bool> $showBorder
     */
    public function SetShowBorder($showBorder) 
    {
        if (! is_bool($showBorder))
        {
           throw new Exception('Invite Friends Error:  ShowBorder parameter is not a boolean type.');
        }
        $this->showBorder = $showBorder;
    }

    /**
     * Call this function with the parameter set to true to show the email invite section.
     * @param <bool> $emailInvite
     */
    public function SetEmailInvite($emailInvite) 
    {
        if (! is_bool($emailInvite))
        {
           throw new Exception('Invite Friends Error:  EmailInvite parameter is not a boolean type.');
        }
        $this->emailInvite = $emailInvite;
    }
    
    /**
     * Call this function with the parameter set to true to show dialog for importing external
     * friends from users email accounts like gmail etc
     * @param <bool> $importExternalFriends
     */
    public function SetImportExternalFriends($importExternalFriends) 
    {
        if (! is_bool($importExternalFriends))
        {
           throw new Exception('Invite Friends Error:  ImportExternalFriends parameter is not a boolean type.');
        }
        $this->importExternalFriends = $importExternalFriends;
    }

    /**
     * Function sets the number of rows. Allowed values are from 3 to 10. Default value is 5.
     * @param <int> $rowsCount
     */
    public function SetRowsCount($rowsCount) 
    {
        if (! is_int($rowsCount))
        {
            throw new Exception("Invite Friends Error:  RowsCount parameter is not an integer type.");
        }
        $this->rowsCount = $rowsCount;
    }

    /**
     * Function sets the number of columns.  Allowed values are from 2,3 and 5. Default value is 5.
     * @param <int> $columnsCount
     */
    public function SetColumsCount($columnsCount) 
    {
        if (! is_int($columnsCount))
        {
            throw new Exception("Invite Friends Error:  ColumnsCount parameter is not an integer type.");
        } 
        $this->columnsCount = $columnsCount;
    }

    /**
     * Function sets the width of rows. Default value is 760.
     * @param <int> $rowsCount
     */
    public function SetWidth($width)
    {
        if (! is_int($width))
        {
            throw new Exception("Invite Friends Error:  Width parameter is not an integer type.");
        }
        $this->width = $width;
    }

    /**
     * Function sets the comma separated list of friends which should not be displayed in the invite control.
     * @param <string> $excludeFriends
     */
    public function SetExcludeFriends($excludeFriends) {$this->excludeFriends = $excludeFriends; }

     /**
     * Function sets the CSS style.
     * @param <string> $cssStyle
     */
    public function SetCssStyle($cssStyle) {$this->cssStyle = $cssStyle;}

    /**
     * Function sets the CSS class.
     * @param <string> $cssClass
     */
    public function SetCssClass($cssClass) {$this->cssClass = $cssClass;}


    /**
    * Get html for creating of this component, depending on defined settings.
    * @return string html
    */
    public function GetOutputHtml()
    {
        // check consistency
        if ($this->actionText == null)
        {
            throw new Exception('Invite Friends Error:  Main Title is not set.');
        }
        if ($this->content == null)
        {
            throw new Exception('Invite Friends Error:  Content is not set.');
        }
        if ($this->confirmButtonText == null)
        {
            throw new Exception('Invite Friends Error:  Confirm Button Title is not set.');
        }

        // set defaults
        if ($this->actionUrl == null)
        {
           $this->actionUrl = AppConfig::GetAppCanvasUrl();
        }
        if ($this->acceptUrl == null)
        {
            $this->acceptUrl = $this->actionUrl;
        }
         if ($this->appName == null)
        {
            $this->appName = AppConfig::GetAppName();
        }

        $html = "<fb:serverfbml ";
        if ($this->width != null)
        {
            $html .= "width='" . $this->width . "' ";
        }
        $html .= ">\n";
        $html .= "<script type='text/fbml'>\n";
        $html .= "<div style='" . $this->cssStyle . "' class='" . $this->cssClass .  "' >\n";
        $html .= "<fb:fbml>\n";
        $html .= "<fb:request-form  method=\"GET\" target=\"_top\" action=\"";
        $html .= $this->actionUrl;
        $html .= "\" content=\"";
        $html .= $this->content;
        $html .= "\n<fb:req-choice url='";
        $html .= $this->acceptUrl;
        $html .= "' label='";
        $html .= $this->confirmButtonText;
        $html .= "' />\"\n type=\"";
        $html .= $this->appName;
        $html .= "\" invite=\"true\">\n";
        $html .= "<fb:multi-friend-selector target=\"_top\" condensed=\"false\" exclude_ids=\"";
        $html .= $this->excludeFriends;
        $html .= "\"  actiontext=\"";
        $html .= $this->actionText;
        $html .= "\" showborder=\"";
        if ($this->showBorder == true)
            $html .= "true";
        else
            $html .= "false";
        $html .= "\" rows=\"";
        $html .= $this->rowsCount;
        if ($this->columnsCount < 5)
        {
            $html .= "\" cols=\"";
            $html .= $this->columnsCount;
        }
        $html .= "\" email_invite=\"";
        if ($this->emailInvite == true)
            $html .= "true";
        else
            $html .= "false";
        $html .= "\" import_external_friends=\"";
        if ($this->importExternalFriends == true)
            $html .= "true";
        else
            $html .= "false";
        $html .= "\" />\n";
        $html .= "</fb:request-form>\n";

        $html .= "</fb:fbml>\n";
        $html .= "</div>";
        $html .= "</script>\n";

        $html .= "</fb:serverfbml>\n";
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
    private $actionUrl = null;
    private $acceptUrl = null;
    private $content = null;
    private $appName = null;
    private $actionText = null;
    private $showBorder = true;
    private $emailInvite = true;
    private $importExternalFriends = true;
    private $confirmButtonText = "Accept";
    private $rowsCount = 5;
    private $columnsCount = 5;
    private $excludeFriends = "";
    private $cssStyle = null;
    private $cssClass = null;
    private $width = 760;
}
?>
