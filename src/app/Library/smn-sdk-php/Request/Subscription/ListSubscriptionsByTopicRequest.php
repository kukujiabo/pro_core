<?php
/**
 * Copyright (C) 2018. Huawei Technologies Co., LTD. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of Apache License, Version 2.0.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * Apache License, Version 2.0 for more details.
 */

namespace SMN\Request\Subscription;

use Http\Http as Http;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;
use SMN\Common\Util\ValidateUtil as ValidateUtil;
use SMN\Exception\SMNException as SMNException;

/**
 * Class ListSubscriptionsByTopicRequest
 * the request for list subscriptions by topic
 * @package SMN\Request\Subscription
 * @author zhangyx
 * @version 1.10
 */
class ListSubscriptionsByTopicRequest extends AbstractRequest
{
    private $topicUrn;
    private $offset = Constants::DEFAULT_OFFSET;
    private $limit = Constants::DEFAULT_LIMIT;

    /**
     * ListTopicsRequest constructor.
     */
    public function __construct()
    {
        $this->offset = Constants::DEFAULT_OFFSET;
        $this->limit = Constants::DEFAULT_LIMIT;
        $this->queryParams["offset"] = $this->offset;
        $this->queryParams["limit"] = $this->limit;
    }

    /**
     * @return mixed|string
     * @throws SMNException
     */
    public function getUrl()
    {
        if (!ValidateUtil::validateLimit($this->limit)) {
            throw new SMNException("SDK.ListSubscriptionsByTopicRequestException", "ListSubscriptionsByTopicRequestException : limit is invalid");
        }
        if (!ValidateUtil::validateOffset($this->offset)) {
            throw new SMNException("SDK.ListSubscriptionsByTopicRequestException", "ListSubscriptionsByTopicRequestException : offset is invalid");

        }

        if (empty($this->topicUrn)) {
            throw new SMNException("SDK.ListSubscriptionsByTopicRequestException", "ListSubscriptionsByTopicRequestException : topic urn is null");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{topicUrn}'), array($this->projectId, $this->topicUrn), Constants::SUBSCRIPTIONS_TOPIC_API_URI));
        array_push($url, parent::getQueryString());
        return join($url);
    }

    /**
     * get method of request
     * @return mixed
     */
    public function getMethod()
    {
        return Http::GET;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->queryParams["offset"] = $offset;
        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        $this->queryParams["limit"] = $limit;
        return $this;
    }

    /**
     * @param $topicUrn
     * @return $this
     */
    public function setTopicUrn($topicUrn)
    {
        $this->topicUrn = $topicUrn;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopicUrn()
    {
        return $this->topicUrn;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }
}