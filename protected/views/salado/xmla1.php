<?xml version="1.0" encoding="utf-8" ?><!--
    Panorama path is pointing to *.xml file describing tiled front wall of cube, name_f.xml as in [f]ront.
    Panorama images must be in Deep Zoom format. You can convert panoramas to Deep Zoom cubes with SaladoConverter.
    Every path to external file in configuration should be preceded by tilde (~). Tilde can be replaced with
    given text when embeding SaladoPlayer into html page that is not located in same directory as *.swf files.

    http://panozona.com/wiki/SaladoPlayer:Configuration#panorama
-->
<SaladoPlayer>
    <global debug="true">

    </global>

    <panoramas>
        <!-- <panorama camera="maxVerticalFov:120,minVerticalFov:-60,pan:-30,tilt:10,fov:200" direction="45" id="s" path="'.$this->createUrl('/salado/index/a/', array('id'=>$datas['scene_id'], 'type'=>'xmlb')).'/s_f.xml"/> -->
        <panorama  id="s" path="/album/index.php/salado/index/b/id/8/s_f.xml">
            <swf id="swf_A" location="pan:-20" path="/album/pages/salado/modules/AdvancedHotspot-1.0.swf" mouse="onClick:helloA,onOver:show_gc_arrowGreen,onOut:hide_gc_arrowGreen">
                <settings path="/album/pages/salado/media/arrow_floor.png" mouseOver="scale:2,time:1,transition:Linear.easeNone" mouseOut="time:1,transition:Expo.easeInOut"/>
            </swf>
            <swf id="swf_B" location="pan:0" path="/album/pages/salado/modules/AdvancedHotspot-1.0.swf" mouse="onClick:helloB,onOver:show_gc_arrowGreen,onOut:hide_gc_arrowGreen">
                <settings path="/album/pages/salado/media/arrow_floor.png" beat="false"/>
            </swf>
        </panorama>
    </panoramas>
    <modules>
        <ButtonBar path="/album/pages/salado/modules/ButtonBar-1.3.swf">
            <window align="horizontal:right,vertical:bottom"/>
            <buttons path="/album/pages/salado/media/buttons_dark_30x30.png">
                <button name="left"/>
                <button name="right"/>
                <button name="down"/>
                <button name="up"/>

                <button name="out"/>
                <button name="in"/>
                <!-- <button name="drag"/>
                <button name="autorotation"/>-->
                <button name="fullscreen"/>
            </buttons>
        </ButtonBar>
        <ImageButton path="/album/pages/salado/modules/ImageButton-1.3.swf">
            <button id="buttonMenuScroller_show" path="/album/pages/salado/media/MenuScroller.png" action="menuScrollerOpen">
                <window align="vertical:bottom,horizontal:right" move="horizontal:-216,vertical:-5" openTween="time:0" closeTween="time:0"/>

            </button>
            <button id="buttonMenuScroller_hide" path="/album/pages/salado/media/MenuScroller.png" action="menuScrollerClose">
                <window align="vertical:bottom,horizontal:right" move="horizontal:-216,vertical:-5" openTween="time:0" closeTween="time:0"/>
            </button>
        </ImageButton>
        <InfoBubble path="/album/pages/salado/modules/InfoBubble-1.3.2.swf">
            <bubbles>
                <image id="bubble_gc_arrowGreen" path="/album/pages/images/thumbs/3.jpg"/>
            </bubbles>

        </InfoBubble>
        <MenuScroller path="/album/pages/salado/modules/MenuScroller.swf">
            <window size="width:700,height:130" open="false" align="horizontal:center,vertical:bottom" transition="type:slideLeft" onOpen="menuScrollerOnOpen" onClose="menuScrollerOnClose"/>/>
            <!-- <close path="/album/pages/salado/media/light_left_close.png" align="horizontal:center,vertical:top" move="vertical:-15"/> -->
            <scroller scrollsVertical="false" sizeLimit="90"/>
            <elements>
                <element target="s" path="/album/pages/images/thumbs/1.jpg"/>
                <element target="s1" path="/album/pages/images/thumbs/2.jpg"/>
                <element target="s2" path="/album/pages/images/thumbs/3.jpg"/>

                <element target="s3" path="/album/pages/images/thumbs/4.jpg"/>
                <element target="s4" path="/album/pages/images/thumbs/2.jpg"/>
                <extraElement id="exxx2" action="helloB" path="/album/pages/images/thumbs/3.jpg"/>
                <extraElement id="exxx1" action="helloA" path="/album/pages/images/thumbs/4.jpg"/>
            </elements>
        </MenuScroller>
        <JSGateway path="/album/pages/salado/modules/JSGateway-1.3.2.swf">
            <settings callOnEnter="true" callOnTransitionEnd="true" callOnMoveEnd="true" callOnViewChange="true"/>
            <jsfunctions>

                <jsfunction id="js1" name="someJavaScriptFunction" text="hello"/>
            </jsfunctions>
            <asfunctions>
                <asfunction name="moveSaladoPlayerToView" callback="saladoPlayer.manager.moveToView"/>
            </asfunctions>
        </JSGateway>
        <LinkOpener path="/album/pages/salado/modules/LinkOpener-1.1.swf">
            <links>
                <link id="panozona" content="http://panozona.com/" target="_SELF"/>

            </links>
        </LinkOpener>
   </modules>
   <actions>
        <action id="toggleOpenMenu" content="MenuScroller.toggleOpen()"/>
        <action id="menuScrollerOpen" content="MenuScroller.setOpen(true)"/>
        <action id="menuScrollerClose" content="MenuScroller.setOpen(false)"/>
        <action id="menuScrollerOnOpen" content="ImageButton.setOpen(buttonMenuScroller_show,false);ImageButton.setOpen(buttonMenuScroller_hide,true)"/>
        <action id="menuScrollerOnClose" content="ImageButton.setOpen(buttonMenuScroller_show,true);ImageButton.setOpen(buttonMenuScroller_hide,true)"/>

        <action id="show_gc_arrowGreen" content="InfoBubble.show(bubble_gc_arrowGreen)"/>
        <action id="hide_gc_arrowGreen" content="InfoBubble.hide()"/>
        <action id="helloA" content="SaladoPlayer.loadPano(s1)"/>
        <action id="helloB" content="LinkOpener.open(panozona)"/>
    </actions>
</SaladoPlayer>